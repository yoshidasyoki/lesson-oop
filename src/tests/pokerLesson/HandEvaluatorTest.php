<?php

namespace PokerLesson\Tests;

require_once(__DIR__ . '/../../src/pokerLesson/HandEvaluator.php');
require_once(__DIR__ . '/../../src/pokerLesson/RuleA.php');
require_once(__DIR__ . '/../../src/pokerLesson/Card.php');

use PHPUnit\Framework\TestCase;
use PokerLesson\HandEvaluator;
use PokerLesson\Card;
use PokerLesson\RuleA;

class HandEvaluatorTest extends TestCase
{
    public function testGetHand()
    {
        $cards = [new Card('H', 10), new Card('C', 10)];
        $handEvaluator = new HandEvaluator(new RuleA());
        $this->assertSame('pair', $handEvaluator->getHand($cards));
    }

    public function testGetWinner()
    {
        $this->assertSame(1, HandEvaluator::getWinner('pair', 'high card'));
    }
}
