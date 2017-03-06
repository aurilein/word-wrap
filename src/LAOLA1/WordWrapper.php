<?php
namespace LAOLA1;

class WordWrapper
{
    private $lineLength;

    public function __construct($lineLength = -1)
    {
        $this->lineLength = $lineLength;
        $this->validateLineLength();
    }

    private function validateLineLength()
    {
        if (!is_numeric($this->lineLength)) {
            throw new \InvalidArgumentException("Invalid line length " . $this->lineLength);
        }

        if ($this->lineLength < 0) {
            throw new \InvalidArgumentException("Negative line length " . $this->lineLength);
        }
    }

    public function wrap($text)
    {
        $text = trim($text);
        if ($this->fitsIntoLine($text)) {
            return $text;
        }

        list($firstLine, $remainingText) = $this->splitFirstLine($text);
        $followingLines = $this->wrap($remainingText);

        return trim($firstLine) . "\n" . $followingLines;
    }

    private function fitsIntoLine($text)
    {
        return strlen($text) <= $this->lineLength;
    }

    private function splitFirstLine($text)
    {
        $firstLine = substr($text, 0, $this->lineLength);
        $lastSpacePosInLine = strrpos($firstLine, ' ');
        $containsSpace = $lastSpacePosInLine !== false;

        if ($containsSpace) {
            return $this->splitAt($text, $lastSpacePosInLine);
        }

        return $this->splitAt($text, $this->lineLength);
    }

    private function splitAt($text, $position)
    {
        $left = substr($text, 0, $position);
        $right = substr($text, $position);

        return [$left, $right];
    }
}
