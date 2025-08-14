<?php

namespace PokerPractice;

use PokerPractice\PokerRule;

class PokerHandEvaluator
{
    public function __construct(private PokerRule $rule)
    {
    }

    public function getHand(): string
    {
        return $this->rule->getHand();
    }

    public function getHandRank(): int
    {
        return $this->rule->getHandRank();
    }

    public function getRsortRanks(): array
    {
        asort($this->rule->getRsortRanks());
        return $this->rule->getRsortRanks();
    }

    // 勝者判定
    public static function judgeWinner(array $handObjs): int
    {
        // 各プレイヤーの役とカードを取得
        $rankHands = array_map(fn($handObj) => $handObj->getHandRank(), $handObjs);
        $sortRanks = array_map(fn($handObj) => $handObj->getRsortRanks(), $handObjs);

        // プレイヤー１の役とカードを取得
        $rankHand1 = $rankHands[0];
        $cards1 = $sortRanks[0];
        // プレイヤー２の役とカードを取得
        $rankHand2 = $rankHands[1];
        $cards2 = $sortRanks[1];

        // 勝敗判定（役の強さ）
        if ($rankHand1 !== $rankHand2) {
            return $rankHand1 > $rankHand2 ? 1 : 2;
        }
        // 勝敗判定（持ちカードで判断）
        foreach (array_map(null, $cards1, $cards2) as [$card1, $card2]) {
            if ($card1 !== $card2) {
                return $card1 > $card2 ? 1 : 2;
            }
        }
        return 0;
    }
}
