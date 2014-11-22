<?php
/**
 * The HabboParser class does all the hard work of delegating data to the correct entities
 */
namespace HabboAPI;

/**
 * Class HabboParser
 *
 * Parses all the uniqe API endpoints
 *
 * @package HabboAPI
 */
class HabboParser {
    /**
     * Base URL for the Habbo API
     *
     * @var string $api_base
     */
    private $api_base;

    /**
     * HabboParser constructor, needs to be injected with $api_base URL
     *
     * @param $api_base
     */
    public function __construct($api_base) {
        $this->api_base = $api_base;
    }

    /**
     * Curl call based on $url
     *
     * @param string $url
     * @return array
     */
    private function _callUrl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'HabboAPI/HabboAPI 1.0.0');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch) or die(curl_error($ch));
        $data = json_decode($json, true);
        $data['habboAPI_info'] = curl_getinfo($ch);
        curl_close($ch);

        return $data;
    }

    /**
     * Parses the Habbo user endpoint
     *
     * @param string $habboname
     * @return Entities\Habbo
     */
    public function parseHabbo($habboname) {
        $data = $this->_callUrl($this->api_base."users?name=".$habboname);

        $habbo = new Entities\Habbo();
        $habbo->parse($data);
        return $habbo;
    }

    /**
     * Parses the Habbo Profile endpoints
     *
     * Return an array including a Habbo entity and 4 arrays with Group, Friend, Room, Badge entities
     *
     * @param string $id
     * @return array
     */
    public function parseProfile($id) {
        // Collect JSON
        $data = $this->_callUrl($this->api_base."users/".$id."/profile");

        // Habbo
        $habbo = new Entities\Habbo();
        $habbo->parse($data['user']);

        // Friends
        $friends = array();
        foreach ($data['friends'] as $friend) {
            $temp_friend = new Entities\Habbo();
            $temp_friend->parse($friend);
            $friends[] = $temp_friend;
            unset($temp_friend);
        }
        // Groups
        $groups = array();
        foreach ($data['groups'] as $group) {
            $temp_group = new Entities\Group();
            $temp_group->parse($group);
            $groups[] = $temp_group;
            unset($temp_group);
        }

        // Rooms
        $rooms = array();
        foreach ($data['rooms'] as $room) {
            $temp_room = new Entities\Room();
            $temp_room->parse($room);
            $rooms[] = $temp_room;
            unset($temp_room);
        }

        // Badges
        $badges = array();
        foreach ($data['badges'] as $badge) {
            $temp_badge = new Entities\Badge();
            $temp_badge->parse($badge);
            $badges[] = $temp_badge;
            unset($temp_badge);
        }

        // Return it all..
        return array(
            "habbo" => $habbo,
            "friends" => $friends,
            "groups" => $groups,
            "rooms" => $rooms,
            "badges" => $badges,
        );
    }

} 