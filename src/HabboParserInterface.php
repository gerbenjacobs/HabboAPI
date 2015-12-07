<?php

namespace HabboAPI;


interface HabboParserInterface
{
    public function parseHabbo($identifier, $useUniqueId = false);

    public function parseProfile($id);

    public function parseHabboPhotos($id);

    public function parsePhotos();
}