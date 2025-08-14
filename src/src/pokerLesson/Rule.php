<?php

namespace PokerLesson;

interface Rule
{
    public function getHand(array $cards);
}
