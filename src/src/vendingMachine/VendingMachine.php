<?php

namespace VendingMachine;
use Exception;

class VendingMachine
{
    // お金の情報を管理するインスタンス
    private PayManagement $payManagement;
    // カップの在庫を管理するインスタンス
    private CupManagement $cupManagement;

    public function __construct()
    {
        $this->payManagement = new PayManagement();
        $this->cupManagement = new CupManagement();
    }

    // 商品のインスタンスを生成するメソッド
    public function categorizeItem(string $itemName): Item|Exception
    {
        $drink = new Drink($itemName);
        $snack = new Snack($itemName);
        // 紙コップを使用する商品はCupManagementを引数に渡す
        $cupDrink = new CupDrink($itemName, $this->cupManagement);

        if (in_array($itemName, $drink->getItemName())) {
            return $drink;
        }
        elseif (in_array($itemName, $cupDrink->getItemName())) {
            return $cupDrink;
        }
        elseif (in_array($itemName, $snack->getItemName())) {
            return $snack;
        } else {
            throw new Exception("Not exist item name: $itemName");
        }
    }

    // コインを投入するメソッド
    public function depositCoin(int $inputCoin): void
    {
        $this->payManagement->inputCoin($inputCoin);
    }

    // ボタンを押してアイテムを購入するメソッド
    public function pressButton(Item $item): string
    {
        $depositedCoin = $this->payManagement->getDepositedCoin();  // 現在投入されているコインの金額を取得
        $price = $item->getPrice();  // 購入するアイテムの価格を取得

        if ($item->canBuyItem($depositedCoin)) {
            $this->payManagement->buyItem($price);  // アイテムの価格分コインを減らす
            $item->buyItem();  // アイテムの購入分だけ在庫を(紙コップを使う商品は紙コップも使用分だけ)減らす
            return $item->getName();  // 購入したアイテムの名前を返す
        }
        return '';  // 在庫切れ等で購入できない場合は空文字を返す
    }

    // アイテムを補充するメソッド
    public function addItem(Item $item, int $addItemNum): void
    {
        $item->addStock($addItemNum);
    }

    // カップの在庫を補充するメソッド
    public function addCup(int $addCupNum): void
    {
        $this->cupManagement->addCup($addCupNum);
    }

    // お釣りを返すメソッド
    public function returnChange(): int
    {
        return $this->payManagement->returnChange();
    }
}
