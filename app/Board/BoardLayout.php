<?php

namespace App\Board;

class BoardLayout
{
    protected $shipPositions = [];
    protected $ships = [];
    protected $layout;

    public function generateLayout()
    {
        $layout = [];
        for ($row = 1; $row <= BoardConfig::VERTICAL_LIMIT; $row++) {
            $layout[$row] = [];

            for ($column = 1; $column <= BoardConfig::HORIZONTAL_LIMIT; $column++) {
                $layout[$row][$column] = BoardConfig::NO_SHOT;
            }
        }

        $this->layout = $layout;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function getCoordinates($position)
    {
        $coordinates = str_split($position);
        // Convert letter to number coordinate
        $coordinates[0] = ord($coordinates[0]) - 64;
        if (isset($coordinates[2])) {
            $coordinates[1] = (int) ($coordinates[1] . $coordinates[2]);
        }

        // first check the row and then column coordinates to avoid notice
        if (count($coordinates) <= 3 && isset($this->layout[$coordinates[0]]) && isset($this->layout[$coordinates[0]][$coordinates[1]])) {
            return $coordinates;
        }

        return false;
    }
}