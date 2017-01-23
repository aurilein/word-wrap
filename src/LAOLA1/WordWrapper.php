<?php
namespace LAOLA1;

class WordWrapper
{
    public function wrap($text, $lineLength)
    {
        if($lineLength < 0)  {
            throw new \InvalidArgumentException("Invalid line length " . $lineLength);
        }
        return $text;
    }
}
