<?php

namespace PokerPractice\Tests;

require_once(__DIR__ . '/../../src/pokerPractice/RuleThreeCards.php');

use PHPUnit\Framework\TestCase;
use PokerPractice\RuleThreeCards;

class RuleThreeCardsTest extends TestCase
{
    public function testGetRsortRanks(): void
    {
        $this->assertSame([12, 10, 1], new RuleThreeCards(['CK', 'D2', 'HJ'])->getRsortRanks());
        $this->assertSame([1, 2, 13], new RuleThreeCards(['C3', 'DA', 'H2'])->getRsortRanks());
    }

    public function testGetHand(): void
    {
        $this->assertSame('high card', new RuleThreeCards(['CK', 'DJ', 'H9'])->getHand());
        $this->assertSame('straight', new RuleThreeCards(['CA', 'S3', 'S2'])->getHand());
        $this->assertSame('high card', new RuleThreeCards(['CA', 'SK', 'S2'])->getHand());
        $this->assertSame('pair', new RuleThreeCards((['C2', 'H2', 'D3']))->getHand());
        $this->assertSame('straight', new RuleThreeCards(['D4', 'C2', 'D3'])->getHand());
        $this->assertSame('straight', new RuleThreeCards(['HK', 'SA', 'DQ'])->getHand());
        $this->assertSame('three of a kind', new RuleThreeCards(['HK', 'SK', 'DK'])->getHand());
    }

    public function testGetHandRank(): void
    {
        $this->assertSame(1, new RuleThreeCards(['CK', 'D3', 'H9'])->getHandRank());
        $this->assertSame(2, new RuleThreeCards(['C2', 'H2', 'D3'])->getHandRank());
        $this->assertSame(3, new RuleThreeCards(['HK', 'SA', 'DQ'])->getHandRank());
        $this->assertSame(4, new RuleThreeCards(['HK', 'SK', 'DK'])->getHandRank());
    }
}
