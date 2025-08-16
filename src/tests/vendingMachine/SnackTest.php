<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/Snack.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\Snack;

class SnackTest extends TestCase
{
    public function testGetItemName(): void
    {
        $snack = new Snack('potato chips');
        $this->assertSame(['potato chips', 'chocolate'], $snack->getItemName());
    }

    public function testGetPrice(): void
    {
        $potatoChips = new Snack('potato chips');
        $this->assertSame(200, $potatoChips->getPrice());
    }

    public function testGetName(): void
    {
        $chocolate = new Snack('chocolate');
        $this->assertSame('chocolate', $chocolate->getName());
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

    public function testBuyItem(): void
    {
        $chocolate = new Snack('chocolate');
        $chocolate->addStock(2);
        $chocolate->buyItem();
        $this->assertSame(1, $chocolate->getStockNum());
    }
}
