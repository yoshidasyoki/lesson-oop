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
    public function testDepositCoin(): void
    {
        $vendingMachine = new VendingMachine();
        $this->assertSame(0, $vendingMachine->DepositCoin(0));
        $this->assertSame(0, $vendingMachine->DepositCoin(150));
        $this->assertSame(100, $vendingMachine->DepositCoin(100));
        $this->assertSame(200, $vendingMachine->DepositCoin(100));
    }
    public function testPressButton(): void
    {
        # ドリンクインスタンスの動作チェック
        $vendingMachine = new VendingMachine();
        $cider = new Drink('cider');
        $cola = new Drink('cola');

        // 在庫補充
        $vendingMachine->depositItem($cider, 1);
        $vendingMachine->depositItem($cola, 1);

        // お金が投入されていない場合は購入できない
        $this->assertSame('', $vendingMachine->pressButton($cider));

        // 100円でサイダーが買える
        $vendingMachine->depositCoin(100);
        $this->assertSame('cider', $vendingMachine->pressButton($cider));

        // 100円ではコーラは購入できない
        $vendingMachine->depositItem($cola, 20);
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($cola));

        // 200円入れるとコーラを購入できる
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositCoin(100);
        $this->assertSame('cola', $vendingMachine->pressButton($cola));

        // 在庫切れだと購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($cider));


        # カップドリンクインスタンスの動作チェック
        $vendingMachine = new VendingMachine();
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $hotCupCoffee = new CupDrink('hot cup coffee');

        // 在庫補充
        $vendingMachine->depositItem($iceCupCoffee, 1);
        $vendingMachine->depositItem($hotCupCoffee, 0);

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
        $chocolate = new Snack('chocolate');
        $potatoChips = new Snack('potato chips');

        // 在庫補充
        $vendingMachine->depositItem($chocolate, 1);
        $vendingMachine->depositItem($potatoChips, 1);

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

    public function testAddCup(): void
    {
        $vendingMachine = new VendingMachine();
        $this->assertSame(99, $vendingMachine->addCup(99));
        $this->assertSame(100, $vendingMachine->addCup(1));
        $this->assertSame(100, $vendingMachine->addCup(1));
    }

    public function testReturnChange(): void
    {
        $vendingMachine = new VendingMachine();
        $cola = new Drink('cola');
        $vendingMachine->depositItem($cola, 25);

        // お金を入れて商品を購入
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositCoin(100);
        $vendingMachine->pressButton($cola);

        // お釣りの返却
        $this->assertSame(50, $vendingMachine->returnChange());
        // 返却後、$depositedCoinが0にリセットされるか確認
        $this->assertSame(0, $vendingMachine->returnChange());
    }

    public function testDepositItem(): void
    {
        $vendingMachine = new VendingMachine();
        $cider = new Drink('cider');

        // 在庫の追加処理
        $vendingMachine->depositItem($cider, 25);
        // 在庫が追加されたかを確認
        $this->assertSame(25, $cider->getStockNum());
    }
}
