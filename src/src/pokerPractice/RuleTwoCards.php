<?php

namespace PokerPractice;

use PokerPractice\PokerRule;
require_once(__DIR__ . '/PokerRule.php');

class RuleTwoCards implements PokerRule
{
    // 役名を定義
    private const HIGH_CARD = 'high card';
    private const PAIR = 'pair';
    private const STRAIGHT = 'straight';

    // 役のランクを定義
    private const array HAND_RANK = [
        self::HIGH_CARD => 1,
        self::PAIR => 2,
        self::STRAIGHT => 3,
    ];

    public function __construct(private array $cards)
    {
    }

    public function getHand(): string
    {
        $ranks = $this->getRsortRanks($this->cards);
        $hand = self::HIGH_CARD;
        if ($this->isStraight($ranks)) {
            $hand = self::STRAIGHT;
        } elseif ($this->isPair($ranks)) {
            $hand = self::PAIR;
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
        if ($this->hasAKCards($rankCards)) {
            return [min($rankCards), max($rankCards)];
        }
        return $rankCards;
    }

    private function isStraight(array $ranks): bool
    {
        return (max($ranks) - min($ranks) === 1 || $this->hasAKCards($ranks));
    }

    private function hasAKCards(array $ranks): bool
    {
        return (max($ranks) - min($ranks) === max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK));
    }

    private function isPair(array $ranks): bool
    {
        return ($ranks[0] === $ranks[1]);
    }
}
