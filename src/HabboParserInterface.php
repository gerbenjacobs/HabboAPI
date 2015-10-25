<?php

namespace HabboAPI;


interface HabboParserInterface
{
    public function parseHabbo($habboName);

    public function parseProfile($id);
}