<?php

namespace App\Ship;

use App\Board\BoardConfig;

class ShipPosition
{
    private $shipPositions;
    private $ships;

    public function __construct(&$shipPositions, &$ships)
    {
        $this->shipPositions = &$shipPositions;
        $this->ships = &$ships;
    }

    public function placeShip(Ship $ship)
    {
        $shipSize = $ship->getSize();
        $placed = false;
        $position = [];

        while (!$placed) {
            // 0 - horizontal orientation
            // 1 - vertical orientation
            $orientation = rand(0, 1);
            $position = ($orientation) ? $this->generateVerticalPosition($shipSize) : $this->generateHorizontalPosition($shipSize);
            $placed = $this->isPositionFree($position);
        }

        $shipId = uniqid();
        $this->ships[$shipId] = $position;
        $this->ships[$shipId]['name'] = $ship->getName();

        $this->addShipPositions($position, $shipId);
    }

    private function isPositionFree($position)
    {
        $isFree = true;
        foreach ($position as $rowKey => $column) {
            foreach ($column as $columnKey => $value) {
                if (isset($this->shipPositions[$rowKey][$columnKey])) {
                    $isFree = false;
                    break;
                }
            }
        }

        return $isFree;
    }

    private function generateHorizontalPosition($shipSize)
    {
        $position = [];
        $row = rand(1, BoardConfig::VERTICAL_LIMIT);
        $columnStart = rand(1, BoardConfig::HORIZONTAL_LIMIT - $shipSize + 1);

        for ($column = $columnStart; $column < $columnStart + $shipSize; $column++) {
            $position[$row][$column] = true;
        }

        return $position;
    }

    private function generateVerticalPosition($shipSize)
    {
        $position = [];
        $rowStart = rand(1, BoardConfig::VERTICAL_LIMIT - $shipSize + 1);
        $column = rand(1, BoardConfig::HORIZONTAL_LIMIT);

        for ($row = $rowStart; $row < $rowStart + $shipSize; $row++) {
            $position[$row][$column] = true;
        }

        return $position;
    }

    private function addShipPositions($position, $shipId)
    {
        foreach ($position as $key => $value) {
            foreach ($value as $columnKey => $columnValue) {
                $value[$columnKey] = $shipId;
            }

            if (isset($this->shipPositions[$key])) {
                $this->shipPositions[$key] += $value;
            } else {
                $this->shipPositions[$key] = $value;
            }
        }
    }
}