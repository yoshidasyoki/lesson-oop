<?php

namespace PokerPractice;

use PokerPractice\PokerRule;
require_once(__DIR__ . '/PokerRule.php');

class RuleThreeCards implements PokerRule
{
    // 役名を定義
    private const HIGH_CARD = 'high card';
    private const PAIR = 'pair';
    private const STRAIGHT = 'straight';
    private const THREE_OF_A_KIND = 'three of a kind';

    // 役のランクを定義
    private const array HAND_RANK = [
        self::HIGH_CARD => 1,
        self::PAIR => 2,
        self::STRAIGHT => 3,
        self::THREE_OF_A_KIND => 4,
    ];

    public function __construct(private array $cards)
    {
    }

    public function getHand(): string
    {
        $ranks = $this->getRsortRanks();
        $hand = self::HIGH_CARD;
        if ($this->isPair($ranks)) {
            $hand = self::PAIR;
        } elseif ($this->isStraight($ranks)) {
            $hand = self::STRAIGHT;
        } elseif ($this->isThreeCard($ranks)) {
            $hand = self::THREE_OF_A_KIND;
        }
        return $hand;
    }

    public function getHandRank(): int
    {
        return self::HAND_RANK[$this->getHand()];
    }

    // 持ち手カードのランクを降順に取得 → 役が等しい場合には持ち手の強さで勝敗判定を行う
    // ここでカードの並びを持ち手の強さ順にして、後の勝敗判定で使用する
    public function getRsortRanks(): array
    {
        $rankCards = array_map(fn($card) => new PokerCard($card)->getRank(), $this->cards);
        rsort($rankCards);
        // カードの組が「A2」のときが最も最弱なので正しく勝敗判定できるようカードの並びを変更
        if ($this->hasA23Cards($rankCards)) {
            sort($rankCards);
        }
        return $rankCards;
    }

    private function isPair(array $ranks): bool
    {
        return (count(array_unique($ranks)) === 2);
    }

    private function isThreeCard(array $ranks): bool
    {
        return (count(array_unique($ranks)) === 1);
    }

    private function isStraight(array $ranks): bool
    {
        return (($ranks[0] - $ranks[1] === 1) && ($ranks[1] - $ranks[2] === 1) ||
                ($this->hasA23Cards($ranks)));
    }

    private function hasA23Cards(array $ranks): bool
    {
        return ((max($ranks) - min($ranks) === max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK)) &&
                $ranks[1] === PokerCard::CARD_RANK['3']);
    }
}
