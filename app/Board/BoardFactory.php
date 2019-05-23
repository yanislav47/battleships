<?php

namespace App\Board;

use App\Ship\Battleship;
use App\Ship\Destroyer;
use App\State\BoardState;

class BoardFactory
{
    public static function create()
    {
        $state = new BoardState();
        $boardState = $state->getState();

        if ($boardState) {
            $board = $boardState;
        } else {
            $board = new Board();
            $board->addShip(new Destroyer);
            $board->addShip(new Destroyer);
            $board->addShip(new Battleship);
            $board->generateLayout();

            $state->saveState($board);
        }

        return $board;
    }
}