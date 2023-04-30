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

    private Habbo $habbo;
    private array $friends = [], $groups = [], $rooms = [], $badges = [];

    /**
     * @param $data
     * @throws Exception
     */
    public function parse($data)
    {
        throw new Exception("The Profile entity can not parse data on its own");
    }

    public function __toString()
    {
        return 'Profile of ' . $this->getHabbo()->getHabboName();
    }

    /**
     * @return Habbo
     */
    public function getHabbo(): Habbo
    {
        return $this->habbo;
    }

    /**
     * @param Habbo $habbo
     */
    public function setHabbo(Habbo $habbo): void
    {
        $this->habbo = $habbo;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->getHabbo()->getId();
    }

    /**
     * @return Habbo[]
     */
    public function getFriends(): array
    {
        return $this->friends;
    }

    /**
     * @param Habbo $friend
     */
    public function addFriend(Habbo $friend): void
    {
        $this->friends[] = $friend;
    }

    /**
     * @return Group[]
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param Group $group
     */
    public function addGroup(Group $group): void
    {
        $this->groups[] = $group;
    }

    /**
     * @return Room[]
     */
    public function getRooms(): array
    {
        return $this->rooms;
    }

    /**
     * @param Room $room
     */
    public function addRoom(Room $room): void
    {
        $this->rooms[] = $room;
    }

    /**
     * @return Badge[]
     */
    public function getBadges(): array
    {
        return $this->badges;
    }

    /**
     * @param Badge $badge
     */
    public function addBadge(Badge $badge): void
    {
        $this->badges[] = $badge;
    }

    /**
     * getCounts is a small helper function to give you
     * an array of each entity in the profile and its count
     * @return array
     */
    public function getCounts(): array
    {
        return array(
            'habbo' => self::safeCount($this->habbo),
            'badges' => self::safeCount($this->badges),
            'friends' => self::safeCount($this->friends),
            'groups' => self::safeCount($this->groups),
            'rooms' => self::safeCount($this->rooms),
        );
    }

    private function safeCount($value): int
    {
        return is_countable($value) ? count($value) : 0;
    }
}

