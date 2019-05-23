<?php

namespace App\Game;

use App\Board\BoardFactory;
use App\State\BoardState;

class GameEngine
{
    private $board;
    private $state;

    public function __construct()
    {
        $this->board = BoardFactory::create();
        $this-> state = new BoardState();
    }

    public function getBoardLayout()
    {
        return $this->board->getLayout();
    }

    public function getShipPositions()
    {
        return $this->board->getShipPositions();
    }

    public function reset()
    {
        $this->state->deleteState();
        $this->board = BoardFactory::create();
    }

    public function shoot($position)
    {
        if ($this->board->shipsDestroyed()) {
            $shotMessage = 'You won the game in ' . $this->board->getShots() . ' shots.';
        } else {
            $shotMessage = $this->board->shoot($position);
            $this->state->saveState($this->board);
        }

        return $shotMessage;
    }
}