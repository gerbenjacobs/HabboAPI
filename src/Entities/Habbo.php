<?php
/**
 * The entity model for a Habbo object
 */

namespace HabboAPI\Entities;

use Carbon\Carbon;
use Countable;
use DateTimeInterface;

/**
 * Class Habbo
 *
 * The model for a Habbo object
 *
 * @package HabboAPI\Entities
 */
class Habbo implements Entity, Countable
{
    private string $id, $habboName, $motto, $figureString;
    private ?DateTimeInterface $memberSince = null, $lastAccessTime = null;
    private bool $online = false, $profileVisible = true;
    private array $selectedBadges = [];
    private int $currentLevel = 0, $currentLevelCompleted = 0, $totalExperience = 0, $starGemCount = 0;


    /** Parses habbo info array to \Entities\Habbo object
     *
     * @param array $data
     */
    public function parse($data): void
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

    protected function setHabboName(string $habboName): void
    {
        $this->habboName = $habboName;
    }

    protected function setMotto(string $motto): void
    {
        $this->motto = $motto;
    }

    protected function setFigureString(string $figureString): void
    {
        $this->figureString = $figureString;
    }

    protected function setProfileVisible(bool $profileVisible): void
    {
        $this->profileVisible = $profileVisible;
    }

    protected function addSelectedBadge(Badge $selectedBadge): void
    {
        $this->selectedBadges[] = $selectedBadge;
    }

    public function setLastAccessTime(string $lastAccessTime): void
    {
        $this->lastAccessTime = Carbon::parse($lastAccessTime);
    }

    public function setCurrentLevelCompleted(int $currentLevelCompleted): void
    {
        $this->currentLevelCompleted = $currentLevelCompleted;
    }

    public function setTotalExperience(int $totalExperience): void
    {
        $this->totalExperience = $totalExperience;
    }

    public function setStarGemCount(int $starGemCount): void
    {
        $this->starGemCount = $starGemCount;
    }

    public function __toString()
    {
        return $this->getHabboName();
    }

    public function getHabboName(): string
    {
        return $this->habboName;
    }

    public function getFigureString(): string
    {
        return $this->figureString;
    }

    public function getId(): string
    {
        return $this->id;
    }

    protected function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getMemberSince(): ?DateTimeInterface
    {
        return $this->memberSince;
    }

    protected function setMemberSince(string $memberSince): void
    {
        $this->memberSince = Carbon::parse($memberSince);
    }

    public function getMotto(): string
    {
        return $this->motto;
    }

    public function getSelectedBadges(): array
    {
        return $this->selectedBadges;
    }

    /**
     * Cleaner method for returning profile visibility
     */
    public function hasProfile(): bool
    {
        return $this->getProfileVisible();
    }

    public function getProfileVisible(): bool
    {
        return $this->profileVisible;
    }

    public function getLastAccessTime(): ?DateTimeInterface
    {
        return $this->lastAccessTime;
    }

    public function getCurrentLevel(): int
    {
        return $this->currentLevel;
    }

    public function setCurrentLevel(int $currentLevel): void
    {
        $this->currentLevel = $currentLevel;
    }

    public function getCurrentLevelCompleted(): int
    {
        return $this->currentLevelCompleted;
    }

    public function getTotalExperience(): int
    {
        return $this->totalExperience;
    }

    public function getStarGemCount(): int
    {
        return $this->starGemCount;
    }

    public function getOnline(): bool
    {
        return $this->online;
    }

    /**
     * Helper function for readability
     */
    public function isOnline(): bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): void
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
    public function count(): int
    {
        return 1;
    }
}
