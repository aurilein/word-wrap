<?php
namespace LAOLA1;

class WordWrapper
{
    public function wrap($text, $lineLength)
    {
        $this->validateLineLength($lineLength);

        $text = trim($text);
        if ($this->fitsIntoLine($text, $lineLength)) {
            return $text;
        }

        list($firstLine, $remainingText) = $this->splitFirstLine($text, $lineLength);
        $followingLines = $this->wrap($remainingText, $lineLength);

        return $firstLine . "\n" . $followingLines;
    }

    private function validateLineLength($lineLength)
    {
        if ($lineLength < 0) {
            throw new \InvalidArgumentException("Invalid line length " . $lineLength);
        }
    }

    private function fitsIntoLine($text, $lineLength)
    {
        return strlen($text) <= $lineLength;
    }

    private function splitFirstLine($text, $lineLength)
    {
        $firstLine = substr($text, 0, $lineLength);
        $spacePos = strrpos($firstLine, ' ');
        $containsSpace = $spacePos !== false;

        if ($containsSpace) {
            $firstLine = substr($text, 0, $spacePos);
            $remainingText = substr($text, $spacePos + 1);
        } else {
            $remainingText = substr($text, $lineLength);
        }

        return array($firstLine, $remainingText);
    }
}
