<?php
/**
 * The entity model for an Achievement object
 */
namespace HabboAPI\Entities;

/**
 * Class Achievement
 *
 * @package HabboAPI\Entities
 */
class Achievement implements Entity
{
    private $id, $name, $category;
    private $requirements;
    private $level, $score;

    /**
     * Parses achievement info array to Achievement object
     * @param $achievement
     */
    public function parse($achievement)
    {
        // add default fields
        $this->id = $achievement['achievement']['id'];
        $this->name = $achievement['achievement']['name'];
        $this->category = $achievement['achievement']['category'];

        // add requirements if available
        if (isset($achievement['requirements'])) {
            // TODO
        }

        // add user state if available
        if (isset($achievement['level'])) {
            $this->level = $achievement['level'];
        }
        if (isset($achievement['score'])) {
            $this->score = $achievement['score'];
        }
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }
}