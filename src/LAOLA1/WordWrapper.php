<?php
namespace LAOLA1;

class WordWrapper
{
    private $lineLength;

    public function __construct($lineLength = -1)
    {
        $this->lineLength = $lineLength;
    }

    public function wrap($text)
    {
        $this->validateLineLength();

        $text = trim($text);
        if ($this->fitsIntoLine($text)) {
            return $text;
        }

        list($firstLine, $remainingText) = $this->splitFirstLine($text);
        $followingLines = $this->wrap($remainingText);

        return $firstLine . "\n" . $followingLines;
    }

    private function validateLineLength()
    {
        if (!is_numeric($this->lineLength)) {
            throw new \InvalidArgumentException("Invalid line length " . $this->lineLength);
        } elseif ($this->lineLength < 0) {
            throw new \InvalidArgumentException("Negative line length " . $this->lineLength);
        }
    }

    private function fitsIntoLine($text)
    {
        return strlen($text) <= $this->lineLength;
    }

    private function splitFirstLine($text)
    {
        $firstLine = substr($text, 0, $this->lineLength);
        $spacePos = strrpos($firstLine, ' ');
        $containsSpace = $spacePos !== false;

        if ($containsSpace) {
            $firstLine = substr($text, 0, $spacePos);
            $remainingText = substr($text, $spacePos + 1);
        } else {
            $remainingText = substr($text, $this->lineLength);
        }

        return array($firstLine, $remainingText);
    }
}
