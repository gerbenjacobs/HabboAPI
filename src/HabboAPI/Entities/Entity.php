<?php
namespace HabboAPI\Entities;


interface Entity
{
    public function parse($data);

    public function __toString();

    public function getId();
} 