<?php

namespace VendingMachine;

abstract class Item
{
    public function __construct(protected string $item)
    {
    }

    public function getName(): string
    {
        return $this->item;
    }

    abstract public function getPrice(): int;
    abstract public function getStockNum(): int;
    abstract public function canBuyItem(int $depositedCoin): bool;
    abstract public function buyItem(): void;
    abstract public function addStock(int $addItemNum): void;
}
