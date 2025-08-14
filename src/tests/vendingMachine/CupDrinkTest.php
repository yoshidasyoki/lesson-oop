<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/CupDrink.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\CupDrink;

class CupDrinkTest extends TestCase
{
    public function testGetPrice(): void
    {
        // 登録されていない商品名は0を返す
        $water = new CupDrink('water');
        $this->assertSame(0, $water->getPrice());

        // 登録されている商品名は価格を返す
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $this->assertSame(100, $iceCupCoffee->getPrice());
    }

    public function testGetName(): void
    {
        // 登録されていない商品名は空値を返す
        $water = new CupDrink('water');
        $this->assertSame('', $water->getName());

        // 登録されている商品名は商品名を返す
        $hotCupCoffee = new CupDrink('hot cup coffee');
        $this->assertSame('hot cup coffee', $hotCupCoffee->getName());
    }

    public function testGetCup(): void
    {
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $this->assertSame(1, $iceCupCoffee->getCup());
    }

    public function testGetStockNum(): void
    {
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $this->assertSame(0, $iceCupCoffee->getStockNum());
    }

    public function testAddStock(): void
    {
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $iceCupCoffee->addStock(1);
        $this->assertSame(1, $iceCupCoffee->getStockNum());
        // 上限以上追加されないか確認
        $iceCupCoffee->addStock(100);
        $this->assertSame(30, $iceCupCoffee->getStockNum());
    }

    public function testReduceStock(): void
    {
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $iceCupCoffee->addStock(2);
        $iceCupCoffee->reduceStock();
        $this->assertSame(1, $iceCupCoffee->getStockNum());
    }
}
