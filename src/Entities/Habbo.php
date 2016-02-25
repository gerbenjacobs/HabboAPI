<?php
/**
 * The entitymodel for a Habbo object
 */
namespace HabboAPI\Entities;
use Carbon\Carbon;

/**
 * Class Habbo
 *
 * The model for a Habbo object
 *
 * @package HabboAPI\Entities
 */
class Habbo implements Entity
{
    private $id;
    private $habboName;
    private $motto;
    private $memberSince;
    private $figureString;
    private $profileVisible;
    private $selectedBadges = array();

    /** Parses habbo info array to \Entities\Habbo object
     *
     * @param array $data
     */
    public function parse($data)
    {
        // These attributes are shared between Habbo and Friends
        $this->setId($data['uniqueId']);
        $this->setHabboName($data['name']);
        $this->setMotto($data['motto']);
        if (isset($data['figureString'])) {
            $this->setFigureString($data['figureString']);
        } elseif (isset($data['habboFigure'])) {
            $this->setFigureString($data['habboFigure']);
        }

        // These could be missing..
        if (isset($data['memberSince'])) {
            $this->setMemberSince($data['memberSince']);
        }

        if (isset($data['profileVisible'])) {
            $this->setProfileVisible($data['profileVisible']);
        }

        if (isset($data['selectedBadges'])) {
            foreach ($data['selectedBadges'] as $badge) {
                $selectedBadge = new Badge();
                $selectedBadge->parse($badge);
                $this->addSelectedBadge($selectedBadge);
            }
        }
    }

    /**
     * @param Badge $selectedBadge
     */
    protected function addSelectedBadge(Badge $selectedBadge)
    {
        array_push($this->selectedBadges, $selectedBadge);
    }

    public function __toString()
    {
        return $this->getHabboName();
    }

    /**
     * @return mixed
     */
    public function getHabboName()
    {
        return $this->habboName;
    }

    /**
     * @param mixed $habboName
     */
    protected function setHabboName($habboName)
    {
        $this->habboName = $habboName;
    }

    /**
     * @return mixed
     */
    public function getFigureString()
    {
        return $this->figureString;
    }

    /**
     * @param mixed $figureString
     */
    protected function setFigureString($figureString)
    {
        $this->figureString = $figureString;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    protected function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Carbon
     */
    public function getMemberSince()
    {
        return $this->memberSince;
    }

    /**
     * @param Carbon $memberSince
     */
    protected function setMemberSince($memberSince)
    {
        $this->memberSince = Carbon::parse($memberSince);
    }

    /**
     * @return mixed
     */
    public function getMotto()
    {
        return $this->motto;
    }

    /**
     * @param mixed $motto
     */
    protected function setMotto($motto)
    {
        $this->motto = $motto;
    }

    /**
     * @return mixed
     */
    public function getProfileVisible()
    {
        return $this->profileVisible;
    }

    /**
     * @param mixed $profileVisible
     */
    protected function setProfileVisible($profileVisible)
    {
        $this->profileVisible = $profileVisible;
    }

    /**
     * @return array of HabboAPI\Entities\Badge objects
     */
    public function getSelectedBadges()
    {
        return $this->selectedBadges;
    }

    /**
     * Cleaner method for returning profile visibility
     * @return boolean
     */
    public function hasProfile()
    {
        return ($this->getProfileVisible()) ? true : false;
    }

}

