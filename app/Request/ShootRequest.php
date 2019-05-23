<?php

namespace App\Request;

use App\Board\Board;
use Symfony\Component\HttpFoundation\Request;
use App\State\BoardState;

class ShootRequest
{
    private $request;
    private $boardState;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->boardState = new BoardState();
    }

    public function isValid()
    {
        $position = $this->request->get('position');
        /** @var Board $board */
        $board = $this->boardState->getState();

        if ($position === 'show' || $board->getCoordinates($position)) {
            return true;
        }

        return false;
    }
}