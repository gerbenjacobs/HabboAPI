<?php

namespace HabboAPI;


interface HabboParserInterface
{
    public function parseHabbo($identifier, $type = "name");

    public function parseProfile($id);
}