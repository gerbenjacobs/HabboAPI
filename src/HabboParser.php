<?php
/**
 * The HabboParser class does all the hard work of delegating data to the correct entities
 */
namespace HabboAPI;

use Exception;
use HabboAPI\Entities\Badge;
use HabboAPI\Entities\Group;
use HabboAPI\Entities\Habbo;
use HabboAPI\Entities\Photo;
use HabboAPI\Entities\Profile;
use HabboAPI\Entities\Room;

/**
 * Class HabboParser
 *
 * Parses all the unique API endpoints
 *
 * @package HabboAPI
 */
class HabboParser implements HabboParserInterface
{
    /**
     * Base URL for the Habbo API
     *
     * @var string $api_base
     */
    private $api_base;

    private $hotel;

    public $cookie;

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
     * Return an associative array including a Habbo entity and 4 arrays with Group, Friend, Room, Badge entities
     *
     * @param string $id
     * @return array
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

    /**
     * Helper function to extract the correct cookie data from Habbo
     * Uses the public photos page as initial example
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
        curl_setopt($ch, CURLOPT_USERAGENT, 'github.com/gerbenjacobs/habbo-api v2.1.1');
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
            throw new Exception($this->_extractError($response), $info['http_code']);
        }
        return array($response, $info);
    }

    private function _extractError($response)
    {
        if (isset($response['errors'])) {
            return $response['errors'][0]['msg'];
        } else if (isset($response['error'])) {
            return $response['error'];
        } else {
            return 'Unknown';
        }
    }
}