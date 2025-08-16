<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/Drink.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\Drink;

class DrinkTest extends TestCase
{
    public function testGetItemName(): void
    {
        $drink = new Drink('cider');
        $this->assertSame(['cider', 'cola'], $drink->getItemName());
    }

    public function testGetPrice(): void
    {
        $item = new Drink('cider');
        $this->assertSame(100, $item->getPrice());
    }

    public function testGetName(): void
    {
        $cider = new Drink('cider');
        $this->assertSame('cider', $cider->getName());
    }

    public function testGetStockNum(): void
    {
        $cider = new Drink('cider');
        $this->assertSame(0, $cider->getStockNum());
    }

    public function testAddStock(): void
    {
        $cider = new Drink('cider');
        $cider->addStock(1);
        $this->assertSame(1, $cider->getStockNum());
        // 上限以上追加されないか確認
        $cider->addStock(100);
        $this->assertSame(50, $cider->getStockNum());
    }

    public function testBuyItem(): void
    {
        $cider = new Drink('cider');
        $cider->addStock(2);
        $cider->buyItem();
        $this->assertSame(1, $cider->getStockNum());
    }
}
