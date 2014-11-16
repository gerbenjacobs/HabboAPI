<?php
namespace HabboAPI;

/**
 * Class HabboAPI
 * @package HabboAPI
 */
class HabboAPI {

    private $api_base = 'https://beta.habbo.com/api/public/';

    /** Can override the API base URL
     * @param string $api_base - Base URL for the API endpoint; https://beta.habbo.com/api/public/
     */
    public function setApiBase($api_base)
    {
        $this->api_base = $api_base;
    }

    public function getHabbo($habboname) {
        $data = $this->_callUrl($this->api_base."users?name=".$habboname);

        $habbo = new Entities\Habbo();
        $habbo->parse($data);
        return $habbo;
    }

    public function getProfile($id) {
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

    private function _callUrl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'HabboAPI/HabboAPI 1.0.0');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch) or die(curl_error($ch));
        curl_close($ch);
        return json_decode($data, true);
    }

}