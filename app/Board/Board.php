<?php

namespace App\Board;

use App\Ship\Ship;
use App\Ship\ShipPosition;

class Board extends BoardLayout
{
    private $shipsDestroyed = false;
    private $shots = 0;

    public function addShip(Ship $ship)
    {
        $shipPosition = new ShipPosition($this->shipPositions, $this->ships);
        $shipPosition->placeShip($ship);
    }

    public function shoot($position)
    {
        $coordinates = $this->getCoordinates($position);
        $row = $coordinates[0];
        $column = $coordinates[1];
        $message = 'You hit';
        $this->shots++;

        if (isset($this->shipPositions[$row][$column])) {
            $this->layout[$row][$column] = BoardConfig::HIT;

            $shipId = $this->shipPositions[$row][$column];
            $shipName = $this->ships[$shipId]['name'];

            if ($this->isVesselSunk($shipId, $row, $column)) {
                if (empty($this->ships)) {
                    $this->shipsDestroyed = true;
                    $message = 'You won the game in '. $this->shots . ' shots';
                } else {
                    $message = 'You sunk a ' . $shipName;
                }
            }

            unset($this->shipPositions[$row][$column]);
        } else {
            $this->layout[$row][$column] = BoardConfig::MISS;
            $message = 'You missed';
        }


        return $message;
    }

    public function getShipPositions()
    {
        return $this->shipPositions;
    }

    public function shipsDestroyed()
    {
        return $this->shipsDestroyed;
    }

    public function getShots()
    {
        return $this->shots;
    }

    private function isVesselSunk($shipId, $row, $column)
    {
        unset($this->ships[$shipId][$row][$column]);
        if (!count($this->ships[$shipId][$row])) {
            unset($this->ships[$shipId][$row]);
        }

        if (count($this->ships[$shipId]) === 1) {
            unset($this->ships[$shipId]);
            return true;
        }

        return false;
    }
}