<?php

namespace PokerPractice\Tests;

require_once(__DIR__ . '/../../src/pokerPractice/PokerHandEvaluator.php');

use PHPUnit\Framework\TestCase;
use PokerPractice\PokerHandEvaluator;
use PokerPractice\RuleTwoCards;
use PokerPractice\RuleThreeCards;
use PokerPractice\RuleFiveCards;

class PokerHandEvaluatorTest extends TestCase
{
    public function testGetHand(): void
    {
        // カードが2枚のとき
        $rule = new RuleTwoCards(['CK', 'DJ']);
        $handEvaluator = new PokerHandEvaluator($rule);
        $this->assertSame('high card',$handEvaluator->getHand());

        $rule = new RuleTwoCards(['CA', 'DA']);
        $handEvaluator = new PokerHandEvaluator($rule);
        $this->assertSame('pair',$handEvaluator->getHand());

        $rule = new RuleTwoCards(['D2', 'SA']);
        $handEvaluator = new PokerHandEvaluator($rule);
        $this->assertSame('straight',$handEvaluator->getHand());

        // カードが3枚のとき
        $rule = new RuleThreeCards(['HA', 'S3', 'DJ']);
        $handEvaluator = new PokerHandEvaluator($rule);
        $this->assertSame('high card', $handEvaluator->getHand());

        $rule = new RuleThreeCards(['H3', 'DK', 'S3']);
        $handEvaluator = new PokerHandEvaluator($rule);
        $this->assertSame('pair', $handEvaluator->getHand());

        $rule = new RuleThreeCards(['D2', 'CA', 'D3']);
        $handEvaluator = new PokerHandEvaluator($rule);
        $this->assertSame('straight', $handEvaluator->getHand());

        $rule = new RuleThreeCards(['DA', 'SA', 'HA']);
        $handEvaluator = new PokerHandEvaluator($rule);
        $this->assertSame('three of a kind', $handEvaluator->getHand());

        // // カードが5枚のとき
        // $handEvaluator = new PokerHandEvaluator(new RuleFiveCards());
        // $this->assertSame('full house', $handEvaluator->getHand(
        //     [new PokerCard('H3'), new PokerCard('C3'), new PokerCard('DJ'), new PokerCard('SJ'), new PokerCard('HJ')]));
    }

    public function testJudgeWinner(): void
    {
        // カードが2枚のとき
        $handObjs = [new RuleTwoCards(['HQ', 'SK']), new RuleTwoCards(['DQ', 'D10'])];
        $this->assertSame(1, PokerHandEvaluator::judgeWinner($handObjs));
        $handObjs = [new RuleTwoCards(['CK', 'DJ']), new RuleTwoCards(['C10', 'H10'])];
        $this->assertSame(2, PokerHandEvaluator::judgeWinner($handObjs));
        $handObjs = [new RuleTwoCards(['SA', 'DK']), new RuleTwoCards(['CK', 'HA'])];
        $this->assertSame(0, PokerHandEvaluator::judgeWinner($handObjs));

        // カードが3枚のとき
        $handObjs = [new RuleThreeCards(['H3', 'C3', 'D3']), new RuleThreeCards(['DK', 'CA', 'HQ'])];
        $this->assertSame(1, PokerHandEvaluator::judgeWinner($handObjs));
        $handObjs = [new RuleThreeCards(['HA', 'C3', 'D2']), new RuleThreeCards(['DK', 'CA', 'HQ'])];
        $this->assertSame(2, PokerHandEvaluator::judgeWinner($handObjs));
        $handObjs = [new RuleThreeCards(['S5', 'H2', 'D9']), new RuleThreeCards(['S9', 'D2', 'H5'])];
        $this->assertSame(0, PokerHandEvaluator::judgeWinner($handObjs));

        // カードが5枚のとき
        $handObjs = [new RuleFiveCards(['H5', 'C5', 'D7', 'S7', 'H8']), new RuleFiveCards(['H4', 'C5', 'D6', 'S7', 'H7'])];
        $this->assertSame(1, PokerHandEvaluator::judgeWinner($handObjs));
        $handObjs = [new RuleFiveCards(['HJ', 'CJ', 'DJ', 'SA', 'HA']), new RuleFiveCards(['HQ', 'CQ', 'DQ', 'SQ', 'HK'])];
        $this->assertSame(2, PokerHandEvaluator::judgeWinner($handObjs));
        $handObjs = [new RuleFiveCards(['HJ', 'CQ', 'DQ', 'SQ', 'HQ']), new RuleFiveCards(['HQ', 'CQ', 'DJ', 'SQ', 'HQ'])];
        $this->assertSame(0, PokerHandEvaluator::judgeWinner($handObjs));
    }
}
