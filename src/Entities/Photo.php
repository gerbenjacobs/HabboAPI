<?php
/**
 * The entity model for a Photo object
 */

namespace HabboAPI\Entities;

use Carbon\Carbon;

class Photo implements Entity
{

    private string $id, $previewUrl, $type, $creatorName, $creatorUniqueId, $url;
    private array $tags, $likes;
    private int $creatorId, $roomId;
    private \DateTimeInterface $takenOn;


    public function parse($data): void
    {
        $this->setId($data['id']);
        $this->setPreviewUrl($data['previewUrl']);
        $this->setTags($data['tags']);
        $this->setType($data['type']);
        $this->setUrl($data['url']);
        $this->setTakenOn($data['time']);
        $this->setCreatorUniqueId($data['creator_uniqueId']);
        $this->setCreatorName($data['creator_name']);
        $this->setCreatorId($data['creator_id']);
        $this->setRoomId($data['room_id']);
        $this->setLikes($data['likes']);
    }

    public function setPreviewUrl(string $previewUrl): void
    {
        $this->previewUrl = $previewUrl;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setCreatorUniqueId(string $creatorUniqueId): void
    {
        $this->creatorUniqueId = $creatorUniqueId;
    }

    public function setCreatorName(string $creatorName): void
    {
        $this->creatorName = $creatorName;
    }

    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }

    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    public function __toString()
    {
        return $this->getUrl();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getPreviewUrl(): string
    {
        return $this->previewUrl;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getCreatorUniqueId(): string
    {
        return $this->creatorUniqueId;
    }

    public function getCreatorName(): string
    {
        return $this->creatorName;
    }

    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    public function setCreatorId(int $creatorId): void
    {
        $this->creatorId = $creatorId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTakenOn(): \DateTimeInterface
    {
        return $this->takenOn;
    }

    /**
     * @param int $takenOn Takes in a timestamp with milliseconds
     */
    public function setTakenOn(int $takenOn): void
    {
        // takenOn is a microtime() format
        $timestamp = floor($takenOn / 1e3);
        $this->takenOn = Carbon::createFromTimestamp($timestamp);
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getLikes(): array
    {
        return $this->likes;
    }
}
