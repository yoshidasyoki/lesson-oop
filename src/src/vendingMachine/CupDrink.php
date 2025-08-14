<?php

namespace VendingMachine;

require_once(__DIR__ . '/Item.php');
use VendingMachine\Item;

class CupDrink extends Item
{
    private const ICE_CUP_COFFEE = 'ice cup coffee';
    private const HOT_CUP_COFFEE = 'hot cup coffee';
    private const MAX_HOT_CUP_COFFEE_NUM = 30;
    private const MAX_ICE_CUP_COFFEE_NUM = 30;

    private const CUP_DRINK = [
        self::ICE_CUP_COFFEE => 100,
        self::HOT_CUP_COFFEE => 100,
    ];

    private array $stock = [
        self::HOT_CUP_COFFEE => ['nowStock' => 0, 'maxStock' => self::MAX_HOT_CUP_COFFEE_NUM],
        self::ICE_CUP_COFFEE => ['nowStock' => 0, 'maxStock' => self::MAX_ICE_CUP_COFFEE_NUM],
    ];

    public function __construct(string $item)
    {
        parent::__construct($item);
    }

    public function getPrice(): int
    {
        return array_key_exists($this->item, self::CUP_DRINK) ? self::CUP_DRINK[$this->item] : 0;
    }

    public function getName(): string
    {
        return array_key_exists($this->item, self::CUP_DRINK) ? $this->item : '';
    }

    public function getCup(): int
    {
        return 1;
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
