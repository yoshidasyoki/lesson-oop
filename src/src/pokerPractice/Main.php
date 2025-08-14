<?php

namespace PokerPractice;

require_once('PokerGame.php');

$game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
var_dump($game->start());
