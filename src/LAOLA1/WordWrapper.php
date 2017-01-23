<?php
namespace LAOLA1;

class WordWrapper
{

    /**
     * WordWrapper constructor.
     */
    public function __construct()
    {
    }

    public function wrap($string, $param)
    {
        throw new \InvalidArgumentException("Ungültige Line Length ".$param);
    }
}
