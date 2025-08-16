<?php

namespace VendingMachine;

class CupManagement
{
    private const int MAX_CUP = 100;
    private int $stockCup = 0;

    // カップを追加するメソッド
    public function addCup(int $addCupNum): int
    {
        $this->stockCup += $addCupNum;
        return ($this->stockCup >= self::MAX_CUP) ? $this->stockCup = self::MAX_CUP : $this->stockCup;
    }

    // 現在のカップの在庫数を取得するメソッド
    public function getStockCup(): int
    {
        return $this->stockCup;
    }

    public function reduceCup(): void
    {
        $this->stockCup -= 1;
    }
}
