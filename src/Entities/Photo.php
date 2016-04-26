<?php

namespace HabboAPI\Entities;


use Carbon\Carbon;

class Photo implements Entity
{

    private $id;
    private $previewUrl;
    private $tags;
    private $creatorUniqueId;
    private $creatorName;
    private $creatorId;
    private $type;
    private $url;
    private $takenOn;
    private $roomId;
    private $likes;

    public function parse($data)
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

    public function __toString()
    {
        return $this->getUrl();
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPreviewUrl()
    {
        return $this->previewUrl;
    }

    /**
     * @param string $previewUrl
     */
    public function setPreviewUrl($previewUrl)
    {
        $this->previewUrl = $previewUrl;
    }

    /**
     * @return string[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string[] $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getCreatorUniqueId()
    {
        return $this->creatorUniqueId;
    }

    /**
     * @param string $creatorUniqueId
     */
    public function setCreatorUniqueId($creatorUniqueId)
    {
        $this->creatorUniqueId = $creatorUniqueId;
    }

    /**
     * @return string
     */
    public function getCreatorName()
    {
        return $this->creatorName;
    }

    /**
     * @param string $creatorName
     */
    public function setCreatorName($creatorName)
    {
        $this->creatorName = $creatorName;
    }

    /**
     * @return int
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * @param int $creatorId
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return Carbon
     */
    public function getTakenOn()
    {
        return $this->takenOn;
    }

    /**
     * @param int $takenOn Takes in a timestamp with milliseconds
     */
    public function setTakenOn($takenOn)
    {
        // takenOn is a microtime() format
        $timestamp = floor($takenOn / 1e3);
        $this->takenOn = Carbon::createFromTimestamp($timestamp);
    }

    /**
     * @return int
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * @param int $roomId
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;
    }

    /**
     * @return string[]
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param string[] $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

}