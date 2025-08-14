<?php

namespace PokerPractice\Tests;

require_once(__DIR__ . '/../../src/pokerPractice/PokerGame.php');

use PHPUnit\Framework\TestCase;
use PokerPractice\PokerGame;

class PokerGameTest extends TestCase
{
    public function testStart(): void
    {
        // カードが2枚の場合
        $game1 = new PokerGame(['CK', 'DJ'], ['C10', 'H10']);
        $this->assertSame(['high card', 'pair', 2], $game1->start());
        $game1 = new PokerGame(['CK', 'DJ'], ['C3', 'H4']);
        $this->assertSame(['high card', 'straight', 2], $game1->start());
        $game1 = new PokerGame(['C3', 'H4'], ['DK', 'SK']);
        $this->assertSame(['straight', 'pair', 1], $game1->start());
        $game1 = new PokerGame(['HJ', 'SK'], ['DQ', 'D10']);
        $this->assertSame(['high card', 'high card', 1], $game1->start());
        $game1 = new PokerGame(['H9', 'SK'], ['DK', 'D10']);
        $this->assertSame(['high card', 'high card', 2], $game1->start());
        $game1 = new PokerGame(['H3', 'S5'], ['D5', 'D3']);
        $this->assertSame(['high card', 'high card', 0], $game1->start());
        $game1 = new PokerGame(['CA', 'DA'], ['C2', 'D2']);
        $this->assertSame(['pair', 'pair', 1], $game1->start());
        $game1 = new PokerGame(['CK', 'DK'], ['CA', 'DA']);
        $this->assertSame(['pair', 'pair', 2], $game1->start());
        $game1 = new PokerGame(['C4', 'D4'], ['H4', 'S4']);
        $this->assertSame(['pair', 'pair', 0], $game1->start());
        $game1 = new PokerGame(['SA', 'DK'], ['C2', 'CA']);
        $this->assertSame(['straight', 'straight', 1], $game1->start());
        $game1 = new PokerGame(['C2', 'CA'], ['S2', 'D3']);
        $this->assertSame(['straight', 'straight', 2], $game1->start());
        $game1 = new PokerGame(['S2', 'D3'], ['C2', 'H3']);
        $this->assertSame(['straight', 'straight', 0], $game1->start());

        // カードが3枚の場合
        $game2 = new PokerGame(['CK', 'DJ', 'H9'], ['C10', 'H10', 'D3']);
        $this->assertSame(['high card', 'pair', 2], $game2->start());
        $game2 = new PokerGame(['CK', 'DA', 'H2'], ['C3', 'H4', 'S5']);
        $this->assertSame(['high card', 'straight', 2], $game2->start());
        $game2 = new PokerGame(['CK', 'DJ', 'H9'], ['C3', 'H3', 'S3']);
        $this->assertSame(['high card', 'three of a kind', 2], $game2->start());
        $game2 = new PokerGame(['C3', 'H4', 'S5'], ['DK', 'SK', 'D10']);
        $this->assertSame(['straight', 'pair', 1], $game2->start());
        $game2 = new PokerGame(['C3', 'H3', 'S3'], ['DK', 'SK', 'D10']);
        $this->assertSame(['three of a kind', 'pair', 1], $game2->start());
        $game2 = new PokerGame(['C3', 'H3', 'S3'], ['DK', 'SJ', 'DQ']);
        $this->assertSame(['three of a kind', 'straight', 1], $game2->start());
        $game2 = new PokerGame(['HJ', 'SK', 'D9'], ['DQ', 'D10', 'H8']);
        $this->assertSame(['high card', 'high card', 1], $game2->start());
        $game2 = new PokerGame(['H9', 'SK', 'H7'], ['DK', 'D10', 'H5']);
        $this->assertSame(['high card', 'high card', 2], $game2->start());
        $game2 = new PokerGame(['H9', 'SK', 'H7'], ['DK', 'D9', 'H5']);
        $this->assertSame(['high card', 'high card', 1], $game2->start());
        $game2 = new PokerGame(['H3', 'S5', 'C7'], ['D5', 'S7', 'D3']);
        $this->assertSame(['high card', 'high card', 0], $game2->start());
        $game2 = new PokerGame(['CA', 'DA', 'DK'], ['C2', 'D2', 'C3']);
        $this->assertSame(['pair', 'pair', 1], $game2->start());
        $game2 = new PokerGame(['CK', 'DK', 'SA'], ['CA', 'DA', 'SK']);
        $this->assertSame(['pair', 'pair', 2], $game2->start());
        $game2 = new PokerGame(['C4', 'D4', 'S7'], ['H4', 'S4', 'C6']);
        $this->assertSame(['pair', 'pair', 1], $game2->start());
        $game2 = new PokerGame(['C4', 'D4', 'S7'], ['H4', 'S4', 'C7']);
        $this->assertSame(['pair', 'pair', 0], $game2->start());
        $game2 = new PokerGame(['SA', 'DK', 'DQ'], ['CA', 'C2', 'D3']);
        $this->assertSame(['straight', 'straight', 1], $game2->start());
        $game2 = new PokerGame(['SA', 'DK', 'DQ'], ['CK', 'CQ', 'DJ']);
        $this->assertSame(['straight', 'straight', 1], $game2->start());
        $game2 = new PokerGame(['S2', 'H3', 'D4'], ['CA', 'C2', 'D3']);
        $this->assertSame(['straight', 'straight', 1], $game2->start());
        $game2 = new PokerGame(['S2', 'S3', 'S4'], ['C2', 'C3', 'D4']);
        $this->assertSame(['straight', 'straight', 0], $game2->start());
        $game2 = new PokerGame(['S2', 'C2', 'D2'], ['CA', 'HA', 'SA']);
        $this->assertSame(['three of a kind', 'three of a kind', 2], $game2->start());
        $game2 = new PokerGame(['SK', 'CK', 'DK'], ['CA', 'HA', 'SA']);
        $this->assertSame(['three of a kind', 'three of a kind', 2], $game2->start());
        $game2 = new PokerGame(['S2', 'C2', 'D2'], ['C3', 'H3', 'S3']);
        $this->assertSame(['three of a kind', 'three of a kind', 2], $game2->start());
    }
}
