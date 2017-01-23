<?php
namespace LAOLA1;

class WordWrapper
{
    public function wrap($text, $lineLength)
    {
        if ($lineLength < 0) {
            throw new \InvalidArgumentException("Invalid line length " . $lineLength);
        }

        if (strlen($text) > $lineLength) {
            return substr($text, 0, $lineLength) . "\n" . substr($text, $lineLength);
        }

        return $text;
    }
}
