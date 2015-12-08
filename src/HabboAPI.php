<?php
/**
 * The HabboAPI class contains all the nice methods
 */
namespace HabboAPI;

use HabboAPI\Entities\Habbo;
use HabboAPI\Entities\Profile;

/** Class HabboAPI
 *
 * Contains all the nice methods for the HabboAPI
 *
 * @package HabboAPI
 */
class HabboAPI
{
    /** Class variable for HabboParser
     *
     * @var \HabboAPI\HabboParser
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
    public function getHabbo($identifier, $useUniqueId = false)
    {
        return $this->parser->parseHabbo($identifier, $useUniqueId);
    }

    /** Based on a unique ID, get a full Habbo profile object
     *
     * @param string $id The unique ID Habbo uses for their api. Starts with "hh<country code>-" (i.e. "hhus-")
     * @return Profile
     */
    public function getProfile($id)
    {
        return $this->parser->parseProfile($id);
    }

}