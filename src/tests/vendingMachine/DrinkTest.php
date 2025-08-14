<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/Drink.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\Drink;

class DrinkTest extends TestCase
{
    public function testGetPrice(): void
    {
        // 登録されていない商品名は0を返す
        $item = new Drink('water');
        $this->assertSame(0, $item->getPrice());

        // 登録されている商品名は価格を返す
        $item = new Drink('cider');
        $this->assertSame(100, $item->getPrice());
    }

    public function testGetName(): void
    {
        // 登録されていない商品名は空値を返す
        $water = new Drink('water');
        $this->assertSame('', $water->getName());

        // 登録されている商品名は商品名を返す
        $cider = new Drink('cider');
        $this->assertSame('cider', $cider->getName());
    }

    public function testGetCup(): void
    {
        $cider = new Drink('cider');
        $this->assertSame(0, $cider->getCup());
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

    public function testReduceStock(): void
    {
        $cider = new Drink('cider');
        $cider->addStock(2);
        $cider->reduceStock();
        $this->assertSame(1, $cider->getStockNum());
    }
}
