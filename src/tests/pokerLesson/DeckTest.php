<?php

namespace PokerLesson\Tests;

require_once(__DIR__ . '/../../src/pokerLesson/Deck.php');

use PHPUnit\Framework\TestCase;
use PokerLesson\Deck;

class DeckTest extends TestCase
{
    public function testDrawCard()
    {
        $deck = new Deck();
        $cards = $deck->drawCards(2);
        $this->assertSame(2, count($cards));
    }
}
