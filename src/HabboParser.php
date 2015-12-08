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

        list($data) = $this->_callUrl($this->api_base . $url);

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
        list($data) = $this->_callUrl($this->api_base . "/api/public/users/" . $id . "/profile");

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
        $url = (isset($id)) ? '/extradata/public/users/' . $id . '/photos' : '/extradata/public/photos';

        list($data) = $this->_callUrl($this->api_base . $url);

        $photos = array();

        foreach ($data as $photo_data) {
            $temp_photo = new Photo();
            $temp_photo->parse($photo_data);
            $photos[] = $temp_photo;
            unset($temp_photo);
        }

        return $photos;
    }

    /**
     * Curl call based on $url
     *
     * @param string $url
     * @return array
     * @throws Exception
     */
    protected function _callUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'github.com/gerbenjacobs/habbo-api v2.0.0');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // urls at /extradata/ require javascript/cookie validation, trick them.
        curl_setopt($ch, CURLOPT_COOKIE, "DOADFgsjnrSFgsg329gaFGa3ggs9434sgSGS43tsgSHSG35=#d6e7d09c41133ce41f6b466b0dbf500980f0f395#BRMM#1450468364#1115280811#");
        $json = curl_exec($ch);
        $response = json_decode($json, true);
        $info = curl_getinfo($ch);

        if ($info['http_code'] != 200) {
            throw new Exception($this->_extractError($response), $info['http_code']);
        }
        curl_close($ch);
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