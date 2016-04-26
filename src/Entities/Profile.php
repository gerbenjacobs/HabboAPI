<?php
/**
 * The entity model for a Profile object
 */

namespace HabboAPI\Entities;

use Exception;

/**
 * Class Profile
 *
 * The model for a Profile object
 *
 * @package HabboAPI\Entities
 */
class Profile implements Entity
{

    private $habbo;
    private $friends;
    private $groups;
    private $rooms;
    private $badges;

    public function parse($data)
    {
        throw new Exception("The Profile entity can not parse data on its own");
    }

    public function __toString()
    {
        return 'Profile of ' . $this->getHabbo()->getHabboName();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getHabbo()->getId();
    }

    /**
     * @return Habbo
     */
    public function getHabbo()
    {
        return $this->habbo;
    }

    /**
     * @param Habbo $habbo
     */
    public function setHabbo(Habbo $habbo)
    {
        $this->habbo = $habbo;
    }

    /**
     * @return Habbo[]
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * @param Habbo $friend
     */
    public function addFriend(Habbo $friend)
    {
        $this->friends[] = $friend;
    }

    /**
     * @return Group[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param Group $group
     */
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;
    }

    /**
     * @return Room[]
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param Room $room
     */
    public function addRoom(Room $room)
    {
        $this->rooms[] = $room;
    }

    /**
     * @return Badge[]
     */
    public function getBadges()
    {
        return $this->badges;
    }

    /**
     * @param Badge $badge
     */
    public function addBadge(Badge $badge)
    {
        $this->badges[] = $badge;
    }

    /**
     * getCounts is a small helper function to give you
     * an array of each entity in the profile and its count
     * @return array
     */
    public function getCounts()
    {
        return array(
            'habbo' => count($this->habbo),
            'badges' => count($this->badges),
            'friends' => count($this->friends),
            'groups' => count($this->groups),
            'rooms' => count($this->rooms),
        );
    }
}

