<?php
/**
 * Created by IntelliJ IDEA.
 * User: Gerben
 * Date: 13-3-2015
 * Time: 0:45
 */

namespace HabboAPI;


interface HabboParserInterface {
    public function parseHabbo($habboName);
    public function parseProfile($id);
}