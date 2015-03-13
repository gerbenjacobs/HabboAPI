<?php
/**
 * The HabboAPI class contains all the nice methods
 */
namespace HabboAPI;

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
     * Constructor, requires a HabboParser object
     * @param HabboParser $parser
     */
    public function __construct(HabboParser $parser)
    {
        $this->parser = $parser;
    }

    /** Based on a username, get a simplified Habbo object
     *
     * @param string $habboname
     * @return Entities\Habbo
     */
    public function getHabbo($habboname)
    {
        return $this->parser->parseHabbo($habboname);
    }

    /** Based on a unique ID, get a full Habbo profile object
     *
     * @param string $id The unique ID system Habbo uses for their api. Starts with "hhus-"
     * @return array
     */
    public function getProfile($id)
    {
        return $this->parser->parseProfile($id);
    }

}