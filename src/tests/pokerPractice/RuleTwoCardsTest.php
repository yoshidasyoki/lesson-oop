<?php

namespace PokerPractice\Tests;

require_once(__DIR__ . '/../../src/pokerPractice/RuleTwoCards.php');

use PHPUnit\Framework\TestCase;
use PokerPractice\RuleTwoCards;

class RuleTwoCardsTest extends TestCase
{
    public function testGetRsortRanks(): void
    {
        $this->assertSame([12, 1], new RuleTwoCards(['CK', 'D2'])->getRsortRanks());
        $this->assertSame([1, 13], new RuleTwoCards(['CA', 'D2'])->getRsortRanks());
    }

    public function testGetHand(): void
    {
        $this->assertSame('high card', new RuleTwoCards(['CK', 'D2'])->getHand());
        $this->assertSame('pair', new RuleTwoCards((['C10', 'A10']))->getHand());
        $this->assertSame('straight', new RuleTwoCards(['CA', 'H2'])->getHand());
        $this->assertSame('straight', new RuleTwoCards(['HK', 'SA'])->getHand());
    }

    public function testGetHandRank(): void
    {
        $this->assertSame(1, new RuleTwoCards(['CK', 'D2'])->getHandRank());
        $this->assertSame(2, new RuleTwoCards(['C10', 'A10'])->getHandRank());
        $this->assertSame(3, new RuleTwoCards(['CA', 'H2'])->getHandRank());
    }
}
