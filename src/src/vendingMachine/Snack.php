<?php

namespace VendingMachine;

require_once(__DIR__ . '/Item.php');
use VendingMachine\Item;

class Snack extends Item
{
    private const POTATO_CHIPS = 'potato chips';
    private const int MAX_POTATO_CHIPS_NUM = 10;
    private const CHOCOLATE = 'chocolate';
    private const int MAX_CHOCOLATE_NUM = 20;

    private const SNACK = [
        self::POTATO_CHIPS => 200,
        self::CHOCOLATE => 100,
    ];

    private array $stock = [
        self::POTATO_CHIPS => ['nowStock' => 0, 'maxStock' => self::MAX_POTATO_CHIPS_NUM],
        self::CHOCOLATE => ['nowStock' => 0, 'maxStock' => self::MAX_CHOCOLATE_NUM],
    ];

    public function __construct(string $item)
    {
        parent::__construct($item);
    }

    public function getPrice(): int
    {
        return array_key_exists($this->item, self::SNACK) ? self::SNACK[$this->item] : 0;
    }

    public function getName(): string
    {
        return array_key_exists($this->item, self::SNACK) ? $this->item : '';
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
