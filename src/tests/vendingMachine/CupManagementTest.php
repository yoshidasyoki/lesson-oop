<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../src/vendingMachine/CupManagement.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\CupManagement;

class CupManagementTest extends TestCase
{
    public function testAddCup(): void
    {
        $cupManagement = new CupManagement();
        $this->assertSame(99, $cupManagement->addCup(99));
        $this->assertSame(100, $cupManagement->addCup(1));
        $this->assertSame(100, $cupManagement->addCup(1));
    }

    public function testGetStockCup(): void
    {
        $cupManagement = new CupManagement();
        $this->assertSame(0, $cupManagement->getStockCup());
        $cupManagement->addCup(50);
        $this->assertSame(50, $cupManagement->getStockCup());
    }

    public function testReduceCup(): void
    {
        $cupManagement = new CupManagement();
        $cupManagement->addCup(2);
        $cupManagement->reduceCup();
        $this->assertSame(1, $cupManagement->getStockCup());
    }
}
