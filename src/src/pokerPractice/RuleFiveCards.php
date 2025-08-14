<?php

namespace PokerPractice;

use PokerPractice\PokerRule;
require_once(__DIR__ . '/PokerRule.php');

class RuleFiveCards implements PokerRule
{
    // 役名を定義
    private const HIGH_CARD = 'high card';
    private const ONE_PAIR = 'one pair';
    private const TWO_PAIR = 'two pair';
    private const THREE_OF_A_KIND = 'three of a kind';
    private const STRAIGHT = 'straight';
    private const FULL_HOUSE = 'full house';
    private const FOUR_OF_A_KIND = 'four of a kind';

    // 役のランクを定義
    private const array HAND_RANK = [
        self::HIGH_CARD => 1,
        self::ONE_PAIR => 2,
        self::TWO_PAIR => 3,
        self::THREE_OF_A_KIND => 4,
        self::STRAIGHT => 5,
        self::FULL_HOUSE => 6,
        self::FOUR_OF_A_KIND => 7,
    ];

    public function __construct(private array $cards)
    {
    }

    public function getHand(): string
    {
        $ranks = $this->getRsortRanks($this->cards);
        $hand = self::HIGH_CARD;
        if ($this->isFullHouse($ranks)) {
            $hand = self::FULL_HOUSE;
        } elseif ($this->isOnePair($ranks)) {
            $hand = self::ONE_PAIR;
        } elseif ($this->isTwoPair($ranks)) {
            $hand = self::TWO_PAIR;
        } elseif ($this->isStraight($ranks)) {
            $hand = self::STRAIGHT;
        } elseif ($this->isThreeCard($ranks)) {
            $hand = self::THREE_OF_A_KIND;
        } elseif ($this->isFourCard($ranks)) {
            $hand = self::FOUR_OF_A_KIND;
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
        return $rankCards;
    }

    private function isOnePair(array $ranks): bool
    {
        return ($this->checkSetCardsCount($ranks, 2) === 1);
    }

    private function isTwoPair(array $ranks): bool
    {
        return ($this->checkSetCardsCount($ranks, 2) === 2);
    }

    private function isStraight(array $ranks): bool
    {
        return (($ranks === [max($ranks), max($ranks) - 1, max($ranks) - 2, max($ranks) - 3, max($ranks) - 4]) ||
                ($ranks === [max(PokerCard::CARD_RANK), min($ranks) + 3, min($ranks) + 2, min($ranks) + 1, min($ranks)]));
    }

    private function isThreeCard(array $ranks): bool
    {
        return ($this->checkSetCardsCount($ranks, 3) === 1);
    }

    private function isFourCard(array $ranks): bool
    {
        return ($this->checkSetCardsCount($ranks, 4) === 1);
    }

    private function isFullHouse(array $ranks): bool
    {
        return ($this->checkSetCardsCount($ranks, 2) === 1 &&
            $this->checkSetCardsCount($ranks, 3) === 1);
    }

    private function checkSetCardsCount(array $ranks, int $sameCardsCount): int
    {
        $check = array_count_values($ranks);
        return (count(array_filter($check, fn($value) => $value === $sameCardsCount)));
    }
}
