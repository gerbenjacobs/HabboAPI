<?php

namespace HabboAPI;


interface HabboParserInterface
{
    public function parseHabbo($identifier, $useUniqueId = false);

    public function parseProfile($id);

    public function parsePhotos($id = null);

    public function parseAchievements($id);
}