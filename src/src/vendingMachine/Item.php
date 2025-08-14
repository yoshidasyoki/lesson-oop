<?php

namespace VendingMachine;

abstract class Item
{
    public function __construct(protected string $item)
    {
    }

    abstract public function getPrice(): int;
    abstract public function getName(): string;
    abstract public function getCup(): int;
    abstract public function getStockNum(): int;
    abstract public function addStock(int $addItemNum): void;
    abstract public function reduceStock(): void;
}
