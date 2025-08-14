<?php

namespace PokerLesson\Tests;

require_once(__DIR__ . '/../../src/pokerLesson/RuleC.php');

use PHPUnit\Framework\TestCase;
use PokerLesson\RuleC;
use PokerLesson\Card;

class RuleCTest extends TestCase
{
    public function testGetHand()
    {
        $cards = [new Card('H', 10), new Card('C', 10)];
        $rule = new RuleC();
        $this->assertSame('straight', $rule->getHand($cards));
    }
}
