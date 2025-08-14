<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/Snack.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\Snack;

class SnackTest extends TestCase
{
    public function testGetPrice(): void
    {
        // 登録されていない商品は0を返す
        $candy = new Snack('candy');
        $this->assertSame(0, $candy->getPrice());

        // 登録されている商品は価格を返す
        $potatoChips = new Snack('potato chips');
        $this->assertSame(200, $potatoChips->getPrice());
    }

    public function testGetName(): void
    {
        // 登録されていない商品は空値を返す
        $candy = new Snack('candy');
        $this->assertSame('', $candy->getName());

        // 登録されている商品は商品名を返す
        $chocolate = new Snack('chocolate');
        $this->assertSame('chocolate', $chocolate->getName());
    }

    public function testGetCup(): void
    {
        $chocolate = new Snack('chocolate');
        $this->assertSame(0, $chocolate->getCup());
    }

    public function testGetStockNum(): void
    {
        $chocolate = new Snack('chocolate');
        $this->assertSame(0, $chocolate->getStockNum());
    }

    public function testAddStock(): void
    {
        $chocolate = new Snack('chocolate');
        $chocolate->addStock(1);
        $this->assertSame(1, $chocolate->getStockNum());
        // 上限以上追加されないか確認
        $chocolate->addStock(100);
        $this->assertSame(20, $chocolate->getStockNum());
    }

    public function testReduceStock(): void
    {
        $chocolate = new Snack('chocolate');
        $chocolate->addStock(2);
        $chocolate->reduceStock();
        $this->assertSame(1, $chocolate->getStockNum());
    }
}
