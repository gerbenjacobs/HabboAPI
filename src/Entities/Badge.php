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
class Badge implements Entity
{
    private $badgeIndex;
    private $code;
    private $name;
    private $description;

    /**
     * Parses badge info array to Badge object
     * @param array $badge
     */
    public function parse($badge)
    {
        if (isset($badge['badgeIndex'])) {
            $this->setBadgeIndex($badge['badgeIndex']);
        }
        $this->setCode($badge['code']);
        $this->setName($badge['name']);
        $this->setDescription($badge['description']);
    }

    public function __toString()
    {
        return '[' . $this->getCode() . '] ' . $this->getName();
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    protected function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getBadgeIndex()
    {
        return $this->badgeIndex;
    }

    /**
     * @param int $badgeIndex
     */
    protected function setBadgeIndex($badgeIndex)
    {
        $this->badgeIndex = $badgeIndex;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    protected function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getCode();
    }
}