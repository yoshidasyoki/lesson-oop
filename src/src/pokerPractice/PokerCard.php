<?php

namespace PokerPractice;

class PokerCard
{
    // カードランクの定義
    public const CARD_RANK = [
        '2' => 1,
        '3' => 2,
        '4' => 3,
        '5' => 4,
        '6' => 5,
        '7' => 6,
        '8' => 7,
        '9' => 8,
        '10' => 9,
        'J' => 10,
        'Q' => 11,
        'K' => 12,
        'A' => 13,
    ];

    public function __construct(private string $card)
    {
    }

    public function getRank(): int
    {
        return self::CARD_RANK[substr($this->card, 1)];
    }
}
