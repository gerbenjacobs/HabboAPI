<?php
/**
 * The entitymodel for a Habbo object
 */
namespace HabboAPI\Entities;

use Carbon\Carbon;
use Countable;

/**
 * Class Habbo
 *
 * The model for a Habbo object
 *
 * @package HabboAPI\Entities
 */
class Habbo implements Entity, Countable
{
    private $id;
    private $habboName;
    private $motto;
    private $memberSince;
    private $lastAccessTime;
    private $online;
    private $figureString;
    private $profileVisible;
    private $selectedBadges = array();
    private $currentLevel;
    private $currentLevelCompleted;
    private $totalExperience;
    private $starGemCount;

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

        // New sandbox 2020 additions
        if (isset($data['online'])) {
            $this->setOnline($data['online']);
        }
        if (isset($data['lastAccessTime'])) {
            $this->setLastAccessTime($data['lastAccessTime']);
        }
        if (isset($data['currentLevel'])) {
            $this->setCurrentLevel($data['currentLevel']);
        }
        if (isset($data['currentLevelCompletePercent'])) {
            $this->setCurrentLevelCompleted($data['currentLevelCompletePercent']);
        }
        if (isset($data['totalExperience'])) {
            $this->setTotalExperience($data['totalExperience']);
        }
        if (isset($data['starGemCount'])) {
            $this->setStarGemCount($data['starGemCount']);
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
     * @return string
     */
    public function getHabboName()
    {
        return $this->habboName;
    }

    /**
     * @param string $habboName
     */
    protected function setHabboName($habboName)
    {
        $this->habboName = $habboName;
    }

    /**
     * @return string
     */
    public function getFigureString()
    {
        return $this->figureString;
    }

    /**
     * @param string $figureString
     */
    protected function setFigureString($figureString)
    {
        $this->figureString = $figureString;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
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
     * @param string $memberSince
     */
    protected function setMemberSince($memberSince)
    {
        $this->memberSince = Carbon::parse($memberSince);
    }

    /**
     * @return string
     */
    public function getMotto()
    {
        return $this->motto;
    }

    /**
     * @param string $motto
     */
    protected function setMotto($motto)
    {
        $this->motto = $motto;
    }

    /**
     * @return boolean
     */
    public function getProfileVisible()
    {
        return $this->profileVisible;
    }

    /**
     * @param boolean $profileVisible
     */
    protected function setProfileVisible($profileVisible)
    {
        $this->profileVisible = $profileVisible;
    }

    /**
     * @return Badge[]
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
        return $this->getProfileVisible();
    }

    /**
     * @return Carbon
     */
    public function getLastAccessTime()
    {
        return $this->lastAccessTime;
    }

    /**
     * @param string $lastAccessTime
     */
    public function setLastAccessTime($lastAccessTime): void
    {
        $this->lastAccessTime = Carbon::parse($lastAccessTime);
    }

    /**
     * @return integer
     */
    public function getCurrentLevel()
    {
        return $this->currentLevel;
    }

    /**
     * @param integer $currentLevel
     */
    public function setCurrentLevel($currentLevel): void
    {
        $this->currentLevel = $currentLevel;
    }

    /**
     * @return integer
     */
    public function getCurrentLevelCompleted()
    {
        return $this->currentLevelCompleted;
    }

    /**
     * @param integer $currentLevelCompleted
     */
    public function setCurrentLevelCompleted($currentLevelCompleted): void
    {
        $this->currentLevelCompleted = $currentLevelCompleted;
    }

    /**
     * @return integer
     */
    public function getTotalExperience()
    {
        return $this->totalExperience;
    }

    /**
     * @param integer $totalExperience
     */
    public function setTotalExperience($totalExperience): void
    {
        $this->totalExperience = $totalExperience;
    }

    /**
     * @return integer
     */
    public function getStarGemCount()
    {
        return $this->starGemCount;
    }

    /**
     * @param integer $starGemCount
     */
    public function setStarGemCount($starGemCount): void
    {
        $this->starGemCount = $starGemCount;
    }

    /**
     * @return boolean
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Helper function for readability
     * @return boolean
     */
    public function isOnline()
    {
        return $this->online;
    }

    /**
     * @param boolean $online
     */
    public function setOnline($online): void
    {
        $this->online = $online;
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return 1;
    }
}
