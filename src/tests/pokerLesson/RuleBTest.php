<?php

namespace PokerLesson\Tests;

require_once(__DIR__ . '/../../src/pokerLesson/RuleB.php');

use PHPUnit\Framework\TestCase;
use PokerLesson\RuleB;
use PokerLesson\Card;

class RuleBTest extends TestCase
{
    public function testGetHand()
    {
        $cards = [new Card('H', 10), new Card('C', 10)];
        $rule = new RuleB();
        $this->assertSame('high card', $rule->getHand($cards));
    }
}
