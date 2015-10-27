<?php

namespace HabboAPI;


interface HabboParserInterface
{
    public function parseHabbo($habboName, $hhid = null);

    public function parseProfile($id);
}