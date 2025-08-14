<?php

namespace PokerPractice\Tests;

require_once(__DIR__ . '/../../src/pokerPractice/PokerCard.php');

use PHPUnit\Framework\TestCase;
use PokerPractice\PokerCard;

class PokerCardTest extends TestCase
{
    public function testGetRank(): void
    {
        $pokerCard = new PokerCard('D2');
        $this->assertSame(1, $pokerCard->getRank());
        $pokerCard = new PokerCard('SK');
        $this->assertSame(12, $pokerCard->getRank());
        $pokerCard = new PokerCard('HA');
        $this->assertSame(13, $pokerCard->getRank());
    }
}
