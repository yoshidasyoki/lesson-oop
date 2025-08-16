<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/PayManagement.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\PayManagement;

class PayManagementTest extends TestCase
{

    public function testGetDepositedCoin(): void
    {
        $payManagement = new PayManagement();
        $this->assertSame(0, $payManagement->getDepositedCoin());
        $payManagement->inputCoin(100);
        $payManagement->inputCoin(100);
        $this->assertSame(200, $payManagement->getDepositedCoin());
    }

    public function testInputCoin(): void
    {
        $payManagement = new PayManagement();
        $payManagement->inputCoin(50);
        $this->assertSame(0, $payManagement->getDepositedCoin());
        $payManagement->inputCoin(100);
        $this->assertSame(100, $payManagement->getDepositedCoin());
        $payManagement->inputCoin(100);
        $this->assertSame(200, $payManagement->getDepositedCoin());
    }

    public function testBuyItem(): void
    {
        $payManagement = new PayManagement();
        $payManagement->inputCoin(100);
        $payManagement->inputCoin(100);
        $payManagement->buyItem(150);
        $this->assertSame(50, $payManagement->getDepositedCoin());
    }

    public function testReturnChange(): void
    {
        $payManagement = new PayManagement();
        $payManagement->inputCoin(100);
        $this->assertSame(100, $payManagement->returnChange());
        $this->assertSame(0, $payManagement->getDepositedCoin());
        $this->assertSame(0, $payManagement->returnChange());
    }
}
