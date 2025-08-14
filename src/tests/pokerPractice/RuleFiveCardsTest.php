<?php

namespace PokerPractice\Tests;

require_once(__DIR__ . '/../../src/pokerPractice/RuleFiveCards.php');

use PHPUnit\Framework\TestCase;
use PokerPractice\RuleFiveCards;

class RuleFiveCardsTest extends TestCase
{
    public function testGetHand(): void
    {
        $this->assertSame('high card', new RuleFiveCards(['H5', 'C7', 'D9', 'SJ', 'HK'])->getHand());
        $this->assertSame('high card', new RuleFiveCards(['H4', 'C3', 'D2', 'SA', 'HK'])->getHand());
        $this->assertSame('high card', new RuleFiveCards(['H3', 'C2', 'DA', 'SK', 'HQ'])->getHand());
        $this->assertSame('high card', new RuleFiveCards(['H2', 'CA', 'DK', 'SQ', 'HJ'])->getHand());
        $this->assertSame('one pair', new RuleFiveCards(['H5', 'C5', 'D6', 'S7', 'H8'])->getHand());
        $this->assertSame('one pair', new RuleFiveCards(['H4', 'C5', 'D5', 'S6', 'H7'])->getHand());
        $this->assertSame('one pair', new RuleFiveCards(['H4', 'C5', 'D6', 'S6', 'H7'])->getHand());
        $this->assertSame('one pair', new RuleFiveCards(['H4', 'C5', 'D6', 'S7', 'H7'])->getHand());
        $this->assertSame('two pair', new RuleFiveCards(['H5', 'C5', 'D7', 'S7', 'H8'])->getHand());
        $this->assertSame('two pair', new RuleFiveCards(['H5', 'C5', 'D6', 'S7', 'H7'])->getHand());
        $this->assertSame('two pair', new RuleFiveCards(['H4', 'C5', 'D5', 'S7', 'H7'])->getHand());
        $this->assertSame('three of a kind', new RuleFiveCards(['H8', 'C9', 'D10', 'S10', 'H10'])->getHand());
        $this->assertSame('three of a kind', new RuleFiveCards(['H8', 'C9', 'D9', 'S9', 'H10'])->getHand());
        $this->assertSame('three of a kind', new RuleFiveCards(['H8', 'C9', 'D10', 'S10', 'H10'])->getHand());
        $this->assertSame('straight', new RuleFiveCards(['HA', 'CK', 'DQ', 'SJ', 'H10'])->getHand());
        $this->assertSame('straight', new RuleFiveCards(['H5', 'C4', 'D3', 'S2', 'HA'])->getHand());
        $this->assertSame('full house', new RuleFiveCards(['HJ', 'CJ', 'DJ', 'SA', 'HA'])->getHand());
        $this->assertSame('full house', new RuleFiveCards(['H3', 'C3', 'DJ', 'SJ', 'HJ'])->getHand());
        $this->assertSame('four of a kind', new RuleFiveCards(['HQ', 'CQ', 'DQ', 'SQ', 'HK'])->getHand());
        $this->assertSame('four of a kind', new RuleFiveCards(['HJ', 'CQ', 'DQ', 'SQ', 'HQ'])->getHand());
    }

    public function testGetHandRank(): void
    {
        $this->assertSame(1, new RuleFiveCards(['H5', 'C7', 'D9', 'SJ', 'HK'])->getHandRank());
        $this->assertSame(2, new RuleFiveCards(['H5', 'C5', 'D6', 'S7', 'H8'])->getHandRank());
        $this->assertSame(3, new RuleFiveCards(['H5', 'C5', 'D6', 'S7', 'H7'])->getHandRank());
        $this->assertSame(4, new RuleFiveCards(['H8', 'C9', 'D10', 'S10', 'H10'])->getHandRank());
        $this->assertSame(5, new RuleFiveCards(['H5', 'C4', 'D3', 'S2', 'HA'])->getHandRank());
        $this->assertSame(6, new RuleFiveCards(['H3', 'C3', 'DJ', 'SJ', 'HJ'])->getHandRank());
        $this->assertSame(7, new RuleFiveCards(['HJ', 'CQ', 'DQ', 'SQ', 'HQ'])->getHandRank());
    }

    public function testGetRsortRanks(): void
    {
        $this->assertSame([13, 4, 3, 2, 1], new RuleFiveCards(['CA', 'D2', 'H4', 'S5', 'S3'])->getRsortRanks());
        $this->assertSame([13, 12, 11, 10, 9], new RuleFiveCards(['CQ', 'DA', 'HJ', 'SK', 'D10'])->getRsortRanks());
    }
}
