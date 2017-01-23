<?php
namespace LAOLA1;

class WordWrapper
{
    public function wrap($text, $lineLength)
    {
        if ($lineLength < 0) {
            throw new \InvalidArgumentException("Invalid line length " . $lineLength);
        }

        if (strlen($text) <= $lineLength) {
            return $text;
        }

        return $this->generateLines($text, $lineLength);
    }

    private function generateLines($text, $lineLength)
    {
        $firstLine = substr($text, 0, $lineLength);
        $remainingText = substr($text, $lineLength);
        $followingLines = $this->wrap($remainingText, $lineLength);
        return $firstLine . "\n" . $followingLines;
    }

}
