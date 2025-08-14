<?php

namespace PokerPractice;

interface PokerRule
{
    public function __construct(array $cards);

    // カードの組み合わせから役名を取得
    public function getHand(): string;

    // 役名のランクを取得
    public function getHandRank(): int;

    // 手持ちカードを取得
    public function getRsortRanks(): array;
}
