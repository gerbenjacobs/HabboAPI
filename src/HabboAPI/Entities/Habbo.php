<?php
namespace HabboAPI\Entities;

class Habbo
{
    private $id;
    private $habboName;
    private $motto;
    private $memberSince;
    private $figureString;
    private $profileVisible;
    private $selectedBadges = array();

    public function parse($data)
    {
        $this->setId($data['uniqueId']);
        $this->setHabboName($data['name']);
        $this->setMotto($data['motto']);
        $this->setFigureString($data['figureString']);

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

    public function __toString() {
        return $this->getHabboName();
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
     * @return mixed
     */
    public function getMemberSince()
    {
        return $this->memberSince;
    }

    /**
     * @param mixed $memberSince
     */
    protected function setMemberSince($memberSince)
    {
        $this->memberSince = $memberSince;
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
     * @param Badge $selectedBadge
     */
    protected function addSelectedBadge(Badge $selectedBadge)
    {
        array_push($this->selectedBadges, $selectedBadge);
    }

}

