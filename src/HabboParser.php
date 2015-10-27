<?php
/**
 * The HabboParser class does all the hard work of delegating data to the correct entities
 */
namespace HabboAPI;

use Exception;
use HabboAPI\Entities\Badge;
use HabboAPI\Entities\Group;
use HabboAPI\Entities\Habbo;
use HabboAPI\Entities\Room;
use InvalidArgumentException;

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

    /**
     * HabboParser constructor, needs to be injected with $api_base URL
     *
     * @param string $api_base
     */
    public function __construct($api_base = 'https://www.habbo.com/api/public/')
    {
        $this->api_base = $api_base;
    }


    /**
     * Parses the Habbo user endpoint
     *
     * @param $identifier
     * @param string $type
     * @return Habbo
     * @throws Exception
     */
    public function parseHabbo($identifier, $type = "name")
    {
        switch ($type) {
            case "name":
                $url = 'users?name=' . $identifier;
                break;
            case "hhid":
                $url = 'users/' . $identifier;
                break;
            default:
                throw new InvalidArgumentException("Invalid type defined for parseHabbo");
        }

        $data = $this->_callUrl($this->api_base . $url);

        $habbo = new Habbo();
        $habbo->parse($data);
        return $habbo;
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
        curl_setopt($ch, CURLOPT_USERAGENT, 'gerbenjacobs/habbo-api 1.0.5');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        $data = json_decode($json, true);
        $data['habboAPI_info'] = curl_getinfo($ch);
        if ($data['habboAPI_info']['http_code'] != 200) {
            throw new Exception('Habbo API replied with an error code: ' . $data['error']);
        }
        curl_close($ch);
        return $data;
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
        $data = $this->_callUrl($this->api_base . "users/" . $id . "/profile");

        // Habbo
        $habbo = new Habbo();
        $habbo->parse($data['user']);

        // Friends
        $friends = array();
        foreach ($data['friends'] as $friend) {
            $temp_friend = new Habbo();
            $temp_friend->parse($friend);
            $friends[] = $temp_friend;
            unset($temp_friend);
        }

        // Groups
        $groups = array();
        foreach ($data['groups'] as $group) {
            $temp_group = new Group();
            $temp_group->parse($group);
            $groups[] = $temp_group;
            unset($temp_group);
        }

        // Rooms
        $rooms = array();
        foreach ($data['rooms'] as $room) {
            $temp_room = new Room();
            $temp_room->parse($room);
            $rooms[] = $temp_room;
            unset($temp_room);
        }

        // Badges
        $badges = array();
        foreach ($data['badges'] as $badge) {
            $temp_badge = new Badge();
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