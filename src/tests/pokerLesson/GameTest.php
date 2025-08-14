<?php

namespace PokerLesson\Tests;

require_once(__DIR__ . '/../../src/pokerLesson/Game.php');

use PHPUnit\Framework\TestCase;
use PokerLesson\Game;

class GameTest extends TestCase
{
    public function testStart()
    {
        $game = new Game('田中', '松本', 2, 'A');
        $result = $game->start();
        $this->assertSame(1, $result);
    }
}
