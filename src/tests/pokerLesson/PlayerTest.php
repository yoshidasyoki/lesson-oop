<?php

namespace PokerLesson\Tests;

require_once(__DIR__ . '/../../src/pokerLesson/Player.php');

use PHPUnit\Framework\TestCase;
use PokerLesson\Player;
use PokerLesson\Deck;

class PlayerTest extends TestCase
{
    public function testDrawCards()
    {
        $deck = new Deck();
        $player = new Player('田中');
        $cards = $player->drawCards($deck, 2);
        $this->assertSame(2, count($cards));
    }
}
