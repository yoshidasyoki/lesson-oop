<?php

namespace VendingMachine;

require_once(__DIR__ . '/Item.php');
use VendingMachine\Item;

class Drink extends Item
{
    private const CIDER = 'cider';
    private const int MAX_CIDER_NUM = 50;
    private const COLA = 'cola';
    private const int MAX_COLA_NUM = 50;

    private const DRINK = [
        self::CIDER => 100,
        self::COLA => 150,
    ];

    private array $stock = [
        self::CIDER => ['nowStock' => 0, 'maxStock' => self::MAX_CIDER_NUM],
        self::COLA => ['nowStock' => 0, 'maxStock' => self::MAX_COLA_NUM],
    ];

    public function __construct(string $item)
    {
        parent::__construct($item);
    }

    public function getItemName(): array
    {
        return array_keys(self::DRINK);
    }

    public function getPrice(): int
    {
        return self::DRINK[$this->item];
    }

    public function getStockNum(): int
    {
        $name = $this->getName();
        return $this->stock[$name]['nowStock'];
    }

    public function canBuyItem(int $depositedCoin): bool
    {
        return $depositedCoin >= $this->getPrice() && $this->getStockNum() > 0;
    }

    public function buyItem(): void
    {
        $name = $this->getName();
        $this->stock[$name]['nowStock'] -= 1;
    }

    public function addStock(int $addStockNum): void
    {
        $name = $this->getName();
        $nowStock = $this->stock[$name]['nowStock'];
        $maxStock = $this->stock[$name]['maxStock'];

        $nowStock += $addStockNum;
        ($nowStock >= $maxStock) ? $this->stock[$name]['nowStock'] = $maxStock : $this->stock[$name]['nowStock'] = $nowStock;
    }
}
