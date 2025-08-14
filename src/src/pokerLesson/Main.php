<?php

namespace PokerLesson;

require_once('Game.php');

$game = new Game('田中', '山田', 2, 'A');
$game->start();
