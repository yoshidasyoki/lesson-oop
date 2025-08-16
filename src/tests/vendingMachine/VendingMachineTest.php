<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/VendingMachine.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\VendingMachine;
use VendingMachine\Drink;
use VendingMachine\CupDrink;
use VendingMachine\Snack;

class VendingMachineTest extends TestCase
{
    public function testCategorizeItem(): void
    {
        $vendingMachine = new VendingMachine();

        // ドリンクのインスタンスを取得
        $drink = $vendingMachine->categorizeItem('cider');
        $this->assertInstanceOf(Drink::class, $drink);

        // // カップドリンクのインスタンスを取得
        $cupDrink = $vendingMachine->categorizeItem('ice cup coffee');
        $this->assertInstanceOf(CupDrink::class, $cupDrink);

        // スナックのインスタンスを取得
        $snack = $vendingMachine->categorizeItem('chocolate');
        $this->assertInstanceOf(Snack::class, $snack);

        // 存在しないアイテム名で例外が投げられるか確認
        $this->expectException(\Exception::class);
        $vendingMachine->categorizeItem('unknown item');
    }

    public function testDepositCoin(): void
    {
        $vendingMachine = new VendingMachine();
        // 100円玉以外は投入できない
        $vendingMachine->depositCoin(50);
        $this->assertSame(0, $vendingMachine->returnChange());
        // 100円玉を投入したときは加算
        $vendingMachine->depositCoin(100);
        $this->assertSame(100, $vendingMachine->returnChange());
    }

    public function testPressButton(): void
    {
        # ドリンクインスタンスの動作チェック
        $vendingMachine = new VendingMachine();
        $cider = $vendingMachine->categorizeItem('cider');
        $cola = $vendingMachine->categorizeItem('cola');

        // 在庫補充
        $vendingMachine->addItem($cider, 1);
        $vendingMachine->addItem($cola, 1);

        // お金が投入されていない場合は購入できない
        $this->assertSame('', $vendingMachine->pressButton($cider));

        // 100円でサイダーが買える
        $vendingMachine->depositCoin(100);
        $this->assertSame('cider', $vendingMachine->pressButton($cider));

        // 100円ではコーラは購入できない
        $vendingMachine->addItem($cola, 20);
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($cola));

        // 200円入れるとコーラを購入できる
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositCoin(100);
        $this->assertSame('cola', $vendingMachine->pressButton($cola));

        // 在庫切れだと購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($cider));


        // # カップドリンクインスタンスの動作チェック
        $vendingMachine = new VendingMachine();
        $iceCupCoffee = $vendingMachine->categorizeItem('ice cup coffee');
        $hotCupCoffee = $vendingMachine->categorizeItem('hot cup coffee');

        // 在庫補充
        $vendingMachine->addItem($iceCupCoffee, 1);
        $vendingMachine->addItem($hotCupCoffee, 0);

        // お金が投入されていない場合は購入できない
        $this->assertSame('', $vendingMachine->pressButton($iceCupCoffee));

        // カップのストックがないと購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($iceCupCoffee));

        // カップが補充されれば購入できる
        $vendingMachine->addCup(20);
        $this->assertSame('ice cup coffee', $vendingMachine->pressButton($iceCupCoffee));

        // 購入するとカップが減るか確認（正常に動作すればカップのストックが足りず購入不可
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($iceCupCoffee));

        // 在庫切れだと購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($hotCupCoffee));


        # スナックインスタンスの動作チェック
        $vendingMachine = new VendingMachine();
        $chocolate = $vendingMachine->categorizeItem('chocolate');
        $potatoChips = $vendingMachine->categorizeItem('potato chips');

        // 在庫補充
        $vendingMachine->addItem($chocolate, 1);
        $vendingMachine->addItem($potatoChips, 1);

        // お金が投入されていない場合は購入できない
        $this->assertSame('', $vendingMachine->pressButton($chocolate));

        // 100円を入れるとチョコレートが購入できる
        $vendingMachine->depositCoin(100);
        $this->assertSame('chocolate', $vendingMachine->pressButton($chocolate));

        // 100円ではポテトチップスは購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($potatoChips));

        // 200円入れるとポテトチップスを購入できる
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositCoin(100);
        $this->assertSame('potato chips', $vendingMachine->pressButton($potatoChips));

        // 在庫切れだと購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($chocolate));
    }

    public function testReturnChange(): void
    {
        $vendingMachine = new VendingMachine();
        $cola = new Drink('cola');
        $vendingMachine->addItem($cola, 25);

        // お金を入れて商品を購入
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositCoin(100);
        $vendingMachine->pressButton($cola);

        // お釣りの返却
        $this->assertSame(50, $vendingMachine->returnChange());
        // 返却後、$depositedCoinが0にリセットされるか確認
        $this->assertSame(0, $vendingMachine->returnChange());
    }

    public function testaddItem(): void
    {
        $vendingMachine = new VendingMachine();
        $cider = new Drink('cider');

        // 在庫の追加処理
        $vendingMachine->addItem($cider, 25);
        // 在庫が追加されたかを確認
        $this->assertSame(25, $cider->getStockNum());
    }
}
