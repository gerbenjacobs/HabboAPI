<?php
/**
 * The HabboParser class does all the hard work of delegating data to the correct entities
 */
namespace HabboAPI;

use Exception;
use HabboAPI\Entities\Achievement;
use HabboAPI\Entities\Badge;
use HabboAPI\Entities\Group;
use HabboAPI\Entities\Habbo;
use HabboAPI\Entities\Photo;
use HabboAPI\Entities\Profile;
use HabboAPI\Entities\Room;
use HabboAPI\Exceptions\HabboNotFoundException;
use HabboAPI\Exceptions\MaintenanceException;
use HabboAPI\Exceptions\UserInvalidException;

/**
 * Class HabboParser
 *
 * Parses all the unique API endpoints
 *
 * @package HabboAPI
 */
class HabboParser implements HabboParserInterface
{
    const VERSION = "2.3.0";

    /**
     * Base URL for the Habbo API
     *
     * @var string $api_base
     */
    private $api_base;

    private $hotel;

    private $cookie;

    /**
     * HabboParser constructor, needs to be injected with $api_base URL
     *
     * @param string $hotel
     */
    public function __construct($hotel = 'com')
    {
        $this->hotel = $hotel;
        $this->api_base = 'https://www.habbo.' . $hotel;
    }


    /**
     * Parses the Habbo user endpoint
     *
     * @param $identifier
     * @param bool $useUniqueId
     * @return Habbo
     * @throws Exception
     */
    public function parseHabbo($identifier, $useUniqueId = false)
    {
        if ($useUniqueId) {
            $url = '/api/public/users/' . $identifier;
        } else {
            $url = '/api/public/users?name=' . $identifier;
        }

        list($data) = $this->_callUrl($this->api_base . $url, true);

        $habbo = new Habbo();
        $habbo->parse($data);
        return $habbo;
    }

    /**
     * Parses the Habbo Profile endpoints
     *
     * Return a Profile object including a Habbo entity and 4 arrays with Group, Friend, Room, Badge entities
     *
     * @param string $id
     * @return Profile
     * @throws Exception
     */
    public function parseProfile($id)
    {
        // Collect JSON
        list($data) = $this->_callUrl($this->api_base . '/api/public/users/' . $id . '/profile', true);

        // Create Profile entity
        $profile = new Profile();

        // Habbo
        $habbo = new Habbo();
        $habbo->parse($data['user']);
        $profile->setHabbo($habbo);

        // Friends
        foreach ($data['friends'] as $friend) {
            $temp_friend = new Habbo();
            $temp_friend->parse($friend);
            $profile->addFriend($temp_friend);
        }

        // Groups
        foreach ($data['groups'] as $group) {
            $temp_group = new Group();
            $temp_group->parse($group);
            $profile->addGroup($temp_group);
        }

        // Rooms
        foreach ($data['rooms'] as $room) {
            $temp_room = new Room();
            $temp_room->parse($room);
            $profile->addRoom($temp_room);
        }

        // Badges
        foreach ($data['badges'] as $badge) {
            $temp_badge = new Badge();
            $temp_badge->parse($badge);
            $profile->addBadge($temp_badge);
        }

        // Return the Profile
        return $profile;
    }

    /**
     * parsePhotos will collect the public photos for an HHID
     * If no $id is given, it will grab the latest photos of the entire hotel
     *
     * @param int|null $id
     * @return Photo[]
     * @throws Exception
     */
    public function parsePhotos($id = null)
    {
        // Get cookie first
        $this->_getCookie();

        $url = (isset($id)) ? '/extradata/public/users/' . $id . '/photos' : '/extradata/public/photos';
        list($data) = $this->_callUrl($this->api_base . $url, true);

        $photos = array();

        if ($data) {
            foreach ($data as $photo_data) {
                $temp_photo = new Photo();
                $temp_photo->parse($photo_data);
                $photos[] = $temp_photo;
                unset($temp_photo);
            }
        }

        return $photos;
    }

    /**
     * parseGroup will return a Group object based on a group ID.
     * It will also contain the members, as an array of Habbo objects.
     *
     * @param $group_id
     * @return Group
     * @throws Exception
     */
    public function parseGroup($group_id)
    {
        list($data) = $this->_callUrl($this->api_base . '/api/public/groups/' . $group_id, true);

        $group = new Group();
        $group->parse($data);

        try {
            list($member_data) = $this->_callUrl($this->api_base . '/api/public/groups/' . $group_id . '/members', true);
        } catch (Exception $e) {
            // Can't collect member data
            $member_data = false;
        }

        if ($member_data) {
            /** @var Habbo[] $members */
            $members = array();
            foreach ($member_data as $member) {
                $temp_habbo = new Habbo();
                $temp_habbo->parse($member);
                $members[] = $temp_habbo;
            }
            $group->setMembers($members);
        }

        return $group;
    }

    /** parseAchievements will return a list of achievements belonging to a Habbo
     * @param $id
     * @return Achievement[]
     * @throws Exception
     */
    public function parseAchievements($id)
    {
        $achievements = array();

        list($data) = $this->_callUrl($this->api_base . '/api/public/achievements/' . $id, true);

        if ($data) {
            foreach ($data as $ach) {
                $tmp_ach = new Achievement();
                $tmp_ach->parse($ach);
                $achievements[] = $tmp_ach;
                unset($tmp_ach);
            }
        }

        return $achievements;
    }

    /**
     * Helper function to extract the correct cookie data from Habbo
     * Uses the public photos page as initial example
     * @throws Exception
     */
    private function _getCookie()
    {
        if (!isset($this->cookie)) {
            // Collect cookie
            list($data) = $this->_callUrl($this->api_base . '/extradata/public/photos', false);
            preg_match("#setCookie\\('(.*)', '(.*)', (.*)\\)#", $data, $matches);
            $this->cookie['key'] = $matches[1];
            $this->cookie['value'] = $matches[2];
        }
    }

    /**
     * Curl call based on $url
     *
     * @param string $url The URL to call
     * @param bool $as_json Return raw or as json; default is json
     * @return array
     * @throws Exception
     */
    protected function _callUrl($url, $as_json = true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'github.com/gerbenjacobs/habbo-api v' . self::VERSION);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // urls at /extradata/ require javascript/cookie validation, trick them.
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookie['key'] . '=' . $this->cookie['value']);
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        // Fetch response
        $response = ($as_json) ? json_decode($data, true) : $data;

        // If something went wrong..
        if ($info['http_code'] != 200) {
            self::throwHabboAPIException($data);
        }
        return array($response, $info);
    }

    public static function throwHabboAPIException($data)
    {
        // Do we find 'maintenance' anywhere?
        if (strstr($data, 'maintenance')) {
            throw new MaintenanceException("Hotel is down for maintenance");
        }

        // Check if data is JSON
        if ($data[0] == "{") { // Quick 'hack' to see if this could be JSON
            $json = json_decode($data, true);
            if (isset($json['errors'])) {
                if ($json['errors'][0]['msg'] == "user.invalid_name") {
                    throw new UserInvalidException("The name you supplied appears to be invalid");
                }
                $defaultMessage = $json['errors'][0]['msg'];
            } else if (isset($json['error'])) {
                if (preg_match('#not-found#', $json['error'])) {
                    throw new HabboNotFoundException("We can not find the Habbo you're looking for");
                }
                $defaultMessage = $json['error'];
            } else {
                $defaultMessage = $json;
            }
        } else {
            $defaultMessage = "An unknown HTML page was returned";
        }

        throw new Exception("Unknown HabboAPI exception occurred: " . $defaultMessage);
    }

    /**
     * setCookie allows you to set the cookie from outside the class
     * Mostly a helper class for the tests
     *
     * @param string $cookie
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
    }
}