<?php

namespace VendingMachine;
require_once(__DIR__ . '/Item.php');

abstract class UseCupItem extends Item
{
    public function __construct(protected string $item, protected CupManagement $cupManagement)
    {
    }
    abstract public function getCup(): int;
}
