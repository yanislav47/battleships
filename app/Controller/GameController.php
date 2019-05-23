<?php

namespace App\Controller;

use App\Board\BoardConfig;
use App\Game\GameEngine;
use App\Request\ShootRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    private $gameEngine;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->gameEngine = new GameEngine();
    }

    public function index()
    {
        return $this->renderBoard();
    }

    public function shoot()
    {
        $shootRequest = new ShootRequest($this->request);
        $parameters = [];

        if ($shootRequest->isValid()) {
            $position = $this->request->get('position');

            if ($position === 'show') {
                $parameters['shipPositions'] = $this->gameEngine->getShipPositions();
            } else {
                $parameters['message'] = $this->gameEngine->shoot($position);
            }
        } else {
            $parameters['message'] = 'Invalid input';
        }

        return $this->renderBoard($parameters);
    }

    public function reset()
    {
        $this->gameEngine->reset();
        return RedirectResponse::create('/');
    }

    private function renderBoard($parameters = [])
    {
        $boardLayout = $this->gameEngine->getBoardLayout();
        $parameters['layout'] = $boardLayout;
        $parameters['rowsCount'] = BoardConfig::HORIZONTAL_LIMIT;
        $parameters['columnsCount'] = BoardConfig::VERTICAL_LIMIT;

        return $this->view->render('index', $parameters);
    }
}