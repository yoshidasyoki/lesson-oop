<?php

namespace PokerPractice;

use PokerPractice\PokerHandEvaluator;
use PokerPractice\RuleTwoCards;
use PokerPractice\RuleThreeCards;
use PokerPractice\RuleFiveCards;

class PokerGame
{
    public function __construct(private array $cards1, private array $cards2)
    {
    }

    public function start(): array
    {
        $handObjs = [];
        foreach ([$this->cards1, $this->cards2] as $cards) {
            $rule = $this->judgeRule($cards);
            $handObjs[] = new PokerHandEvaluator($rule);
        }
        // 各プレイヤーの役名を取得
        $hands = array_map(fn($handObj) => $handObj->getHand(), $handObjs);
        // 勝者判定
        $winner = PokerHandEvaluator::judgeWinner($handObjs);
        $result = [$hands[0], $hands[1], $winner];
        return $result;
    }

    // 枚数によってルール分け
    private function judgeRule(array $cards): PokerRule
    {
        $rule = new RuleTwoCards($cards);
        if (count($cards) === 3) {
            $rule = new RuleThreeCards($cards);
        } elseif (count($cards) === 5) {
            $rule = new RuleFiveCards($cards);
        }
        return $rule;
    }
}
