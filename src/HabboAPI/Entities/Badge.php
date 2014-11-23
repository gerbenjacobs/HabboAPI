<?php
/**
 * The entitymodel for a Badge object
 */
namespace HabboAPI\Entities;

/**
 * Class Badge
 *
 * @package HabboAPI\Entities
 */
class Badge implements Entity {
    private $badgeIndex;
    private $code;
    private $name;
    private $description;

    /**
     * Parses badge info array to \Entities\Badge object
     * @param array $badge
     */
    public function parse($badge)
    {
        if (isset($badge['badgeIndex'])) {
            $this->setBadgeIndex($badge['badgeIndex']);
        }
        $this->setCode($badge['code']);
        $this->setDescription($badge['description']);
        $this->setName($badge['name']);
    }

    public function __toString() {
        return '['.$this->getCode().'] '.$this->getName();
    }

    /**
     * @return mixed
     */
    public function getBadgeIndex()
    {
        return $this->badgeIndex;
    }

    /**
     * @param mixed $badgeIndex
     */
    protected function setBadgeIndex($badgeIndex)
    {
        $this->badgeIndex = $badgeIndex;
    }


    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    protected function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    protected function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }
}