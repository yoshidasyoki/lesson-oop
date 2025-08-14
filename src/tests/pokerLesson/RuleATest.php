<?php

namespace PokerLesson\Tests;

require_once(__DIR__ . '/../../src/pokerLesson/RuleA.php');

use PHPUnit\Framework\TestCase;
use PokerLesson\RuleA;
use PokerLesson\Card;

class RuleATest extends TestCase
{
    public function testGetHand()
    {
        $cards = [new Card('H', 10), new Card('C', 10)];
        $rule = new RuleA();
        $this->assertSame('pair', $rule->getHand($cards));
    }
}
