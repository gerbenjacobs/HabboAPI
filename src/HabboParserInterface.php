<?php

namespace HabboAPI;


interface HabboParserInterface
{
    public function parseHabbo(string $identifier, bool $useUniqueId = false);

    public function parseProfile(string $id);

    public function parsePhotos(string $id = null);

    public function parseAchievements(string $id);
}