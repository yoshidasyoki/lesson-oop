<?php

namespace VendingMachine;

class PayManagement
{
    private const array USE_COIN = [
        100,
    ];
    private int $depositedCoin = 0;

    public function getDepositedCoin(): int
    {
        return $this->depositedCoin;
    }

    public function inputCoin(int $inputCoin): void
    {
        (in_array($inputCoin, self::USE_COIN)) ? $this->depositedCoin += $inputCoin : $this->depositedCoin += 0;
    }

    public function buyItem(int $itemPrice): void
    {
        $this->depositedCoin -= $itemPrice;
    }

    public function returnChange(): int
    {
        $returnChange = $this->depositedCoin;
        $this->depositedCoin = 0;
        return $returnChange;
    }
}
