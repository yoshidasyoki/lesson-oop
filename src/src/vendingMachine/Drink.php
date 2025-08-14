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

    public function getPrice(): int
    {
        return array_key_exists($this->item, self::DRINK) ? self::DRINK[$this->item] : 0;
    }

    public function getName(): string
    {
        return array_key_exists($this->item, self::DRINK) ? $this->item : '';
    }

    public function getCup(): int
    {
        return 0;
    }

    public function getStockNum(): int
    {
        $name = $this->getName();
        return $this->stock[$name]['nowStock'];
    }

    public function addStock(int $addStockNum): void
    {
        $name = $this->getName();
        $nowStock = $this->stock[$name]['nowStock'];
        $maxStock = $this->stock[$name]['maxStock'];

        $nowStock += $addStockNum;
        ($nowStock >= $maxStock) ? $this->stock[$name]['nowStock'] = $maxStock : $this->stock[$name]['nowStock'] = $nowStock;
    }

    public function reduceStock(): void
    {
        $name = $this->getName();
        $this->stock[$name]['nowStock'] -= 1;
    }
}
