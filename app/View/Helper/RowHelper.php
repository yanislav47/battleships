<?php

namespace App\View\Helper;

use Symfony\Component\Templating\Helper\HelperInterface;

class RowHelper implements HelperInterface
{
    /**
     * @var string
     */
    private $charset = 'utf-8';

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param string $charset
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'row';
    }

    /**
     * @param integer $row
     * @return string
     */
    public function output($row)
    {
        return chr($row + 64);
    }
}