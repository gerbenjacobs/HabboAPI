<?php
/**
 * The HabboAPI class contains all the nice methods
 */
namespace HabboAPI;

use Exception;
use HabboAPI\Entities\Group;
use HabboAPI\Entities\Habbo;
use HabboAPI\Entities\Photo;
use HabboAPI\Entities\Profile;
use HabboAPI\Entities\Achievement;

/** Class HabboAPI
 *
 * Contains all the nice methods for the HabboAPI
 *
 * @package HabboAPI
 */
class HabboAPI
{
    const VERSION = "6.0.0";

    /** Class variable for HabboParser
     *
     * @var HabboParserInterface
     */
    private $parser;

    /**
     * Constructor, requires an implementation of a HabboParserInterface
     * @param HabboParserInterface $parser
     */
    public function __construct(HabboParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /** Based on a username, get a simplified Habbo object
     *
     * @param string $identifier
     * @param bool $useUniqueId
     * @return Habbo
     */
    public function getHabbo(string $identifier, bool $useUniqueId = false): Habbo
    {
        return $this->parser->parseHabbo($identifier, $useUniqueId);
    }

    /** Based on a unique ID, get a full Habbo profile object
     *
     * @param string $id The unique ID Habbo uses for their api. Starts with "hh<country code>-" (i.e. "hhus-")
     * @return Profile
     */
    public function getProfile(string $id): Profile
    {
        return $this->parser->parseProfile($id);
    }

    /** getPhotos returns all 200 public photos or all the users photos if an id is given
     *
     * @param string|null $id The unique ID Habbo uses for their api. Starts with "hh<country code>-" (i.e. "hhus-")
     * @return Photo[] Array of Photo objects
     */
    public function getPhotos(string $id = null): array
    {
        return $this->parser->parsePhotos($id);
    }

    /** getGroup will collect the group info and, if available, the members of said group
     *
     * @param $group_id
     * @return Group
     * @throws Exception
     */
    public function getGroup($group_id): Group
    {
        return $this->parser->parseGroup($group_id);
    }

    /** getAchievements returns a Habbo's achievements
     * @param string $id The unique ID Habbo uses for their api. Starts with "hh<country code>-" (i.e. "hhus-")
     * @return Achievement[]
     */
    public function getAchievements(string $id): array
    {
        return $this->parser->parseAchievements($id);
    }
}