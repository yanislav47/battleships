<?php

namespace App\State;

use App\Board\Board;

class BoardState
{
    private $board;

    public function __construct($board = 'default')
    {
        $this->board = $board;
    }

    public function getState()
    {
        if (isset($_SESSION[$this->board])) {
            $state = unserialize($_SESSION[$this->board]);
            return $state;
        }

        return null;
    }

    /**
     * @param Board $state
     */
    public function saveState(Board $state)
    {
        $state = serialize($state);
        $_SESSION[$this->board] = $state;
    }

    public function deleteState()
    {
        unset($_SESSION[$this->board]);
    }
}