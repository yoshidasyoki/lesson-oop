<?php

namespace VendingMachine;

class VendingMachine
{
    private const int USE_COIN = 100;
    private const int MAX_CUP = 100;

    private int $depositedCoin = 0;
    private int $stockCup = 0;

    public function depositCoin(int $inputCoin): int
    {
        return ($inputCoin === self::USE_COIN) ? $this->depositedCoin += $inputCoin : $this->depositedCoin += 0;
    }

    public function pressButton(Item $item): string
    {
        $price = $item->getPrice();
        $useCup = $item->getCup();
        $stockItem = $item->getStockNum();

        if ($this->depositedCoin >= $price && $this->hasCup($useCup) && $this->hasStock($stockItem)) {
            $this->depositedCoin -= $price;
            $this->stockCup -= $useCup;
            $item->reduceStock();
            return $item->getName();
        }
        return '';
    }

    public function addCup(int $addCupNum): int
    {
        $this->stockCup += $addCupNum;
        return ($this->stockCup >= self::MAX_CUP) ? $this->stockCup = self::MAX_CUP : $this->stockCup;
    }

    public function depositItem(Item $item, int $addItemNum): void
    {
        $item->addStock($addItemNum);
    }

    public function returnChange(): int
    {
        $returnChange = $this->depositedCoin;
        $this->depositedCoin = 0;
        return $returnChange;
    }

    private function hasCup(int $useCup): bool
    {
        return $this->stockCup >= $useCup;
    }

    private function hasStock(int $stockItem): bool
    {
        return $stockItem >= 1;
    }
}
