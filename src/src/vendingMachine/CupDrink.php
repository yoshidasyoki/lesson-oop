<?php

namespace VendingMachine;

require_once(__DIR__ . '/UseCupItem.php');

class CupDrink extends UseCupItem
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

    private CupManagement $cupDrinkStock;

    public function __construct(string $item, CupManagement $cupDrinkStock)
    {
        parent::__construct($item, $cupDrinkStock);
        $this->cupDrinkStock = $cupDrinkStock;
    }

    public function getItemName(): array
    {
        return array_keys(self::CUP_DRINK);
    }

    public function getPrice(): int
    {
        return self::CUP_DRINK[$this->item];
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

    public function canBuyItem(int $depositedCoin): bool
    {
        return (($depositedCoin >= $this->getPrice()) && ($this->getStockNum() > 0) && ($this->cupDrinkStock->getStockCup() > 0));
    }

    public function buyItem(): void
    {
        $name = $this->getName();
        $this->stock[$name]['nowStock'] -= 1;
        $this->cupDrinkStock->reduceCup();
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
