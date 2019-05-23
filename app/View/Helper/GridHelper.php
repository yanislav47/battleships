<?php

namespace App\View\Helper;

use App\Board\BoardConfig;
use Symfony\Component\Templating\Helper\HelperInterface;

class GridHelper implements HelperInterface
{
    private $charset = 'utf-8';

    public function getCharset()
    {
        return $this->charset;
    }

    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    public function getName()
    {
        return 'grid';
    }

    public function output($squareValue, $shipPositions, $coordinates)
    {
        return ($squareValue === BoardConfig::HIT || isset($shipPositions[$coordinates[0]][$coordinates[1]]))
            ? BoardConfig::HIT : '';
    }
}