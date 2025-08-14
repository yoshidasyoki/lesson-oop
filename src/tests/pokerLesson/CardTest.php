<?php

namespace PokerLesson\Tests;

require_once(__DIR__ . '/../../src/pokerLesson/Card.php');

use PHPUnit\Framework\TestCase;
use PokerLesson\Card;

class CardTest extends TestCase
{
    public function testGetSuit()
    {
        $card = new Card('C', 5);
        $this->assertSame('C', $card->getSuit());
    }

    public function testGetNumber()
    {
        $card = new Card('C', 5);
        $this->assertSame(5, $card->getNumber());
    }
}
