<?php
namespace LAOLA1;

class WordWrapper
{
    public function wrap($text, $lineLength)
    {
        throw new \InvalidArgumentException("Invalid line length " . $lineLength);
    }
}
