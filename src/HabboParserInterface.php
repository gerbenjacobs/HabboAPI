<?php

namespace HabboAPI;


interface HabboParserInterface
{
    public function parseHabbo($identifier, $useUniqueId = false);

    public function parseProfile($id);
}