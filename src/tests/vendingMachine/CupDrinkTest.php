<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/CupDrink.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\CupDrink;
use VendingMachine\CupManagement;
use VendingMachine\VendingMachine;

class CupDrinkTest extends TestCase
{
    public function testGetItemName(): void
    {
        $cupManagement = new CupManagement();
        $cupDrink = new CupDrink('ice cup coffee', $cupManagement);
        $this->assertSame(['ice cup coffee', 'hot cup coffee'], $cupDrink->getItemName());
    }

    public function testGetPrice(): void
    {

        $iceCupCoffee = new CupDrink('ice cup coffee', new CupManagement());
        $this->assertSame(100, $iceCupCoffee->getPrice());
    }

    public function testGetName(): void
    {
        $hotCupCoffee = new CupDrink('hot cup coffee', new CupManagement());
        $this->assertSame('hot cup coffee', $hotCupCoffee->getName());
    }

    public function testGetStockNum(): void
    {
        $iceCupCoffee = new CupDrink('ice cup coffee', new CupManagement());
        $this->assertSame(0, $iceCupCoffee->getStockNum());
    }

    public function testAddStock(): void
    {
        $iceCupCoffee = new CupDrink('ice cup coffee', new CupManagement());
        $iceCupCoffee->addStock(1);
        $this->assertSame(1, $iceCupCoffee->getStockNum());
        // 上限以上追加されないか確認
        $iceCupCoffee->addStock(100);
        $this->assertSame(30, $iceCupCoffee->getStockNum());
    }

    public function testCanBuyItem(): void
    {
        // 在庫あり・カップあり → 購入可能
        $vendingMachine = new VendingMachine();
        $iceCupCoffee = new CupDrink('ice cup coffee', $cupManagement = new CupManagement());

        $iceCupCoffee->addStock(20);
        $cupManagement->addCup(20);
        $vendingMachine->depositCoin(100);
        $this->assertTrue($iceCupCoffee->canBuyItem($iceCupCoffee->getPrice()));

        // 在庫あり・カップなし → 購入不可
        $vendingMachine = new VendingMachine();
        $iceCupCoffee = new CupDrink('ice cup coffee', $cupManagement = new CupManagement());
        $iceCupCoffee->addStock(20);
        $cupManagement->addCup(0);
        $vendingMachine->depositCoin(100);
        $this->assertFalse($iceCupCoffee->canBuyItem($iceCupCoffee->getPrice()));

        // 在庫なし・カップなし → 購入不可
        $vendingMachine = new VendingMachine();
        $iceCupCoffee = new CupDrink('ice cup coffee', $cupManagement = new CupManagement());
        $iceCupCoffee->addStock(0);
        $cupManagement->addCup(0);
        $vendingMachine->depositCoin(100);
        $this->assertFalse($iceCupCoffee->canBuyItem($iceCupCoffee->getPrice()));
    }

    public function testBuyItem(): void
    {
        $iceCupCoffee = new CupDrink('ice cup coffee', new CupManagement());
        $iceCupCoffee->addStock(2);
        $iceCupCoffee->buyItem();
        $this->assertSame(1, $iceCupCoffee->getStockNum());
    }

    public function testGetCup(): void
    {
        $iceCupCoffee = new CupDrink('ice cup coffee', new CupManagement());
        $this->assertSame(1, $iceCupCoffee->getCup());
    }
}
