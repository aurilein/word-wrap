<?php
namespace LAOLA1;

class WordWrapper
{
    public function wrap($text, $lineLength)
    {
        if ($lineLength < 0) {
            throw new \InvalidArgumentException("Invalid line length " . $lineLength);
        }

        $text = trim($text);
        if (strlen($text) <= $lineLength) {
            return $text;
        }

        return $this->getWrappedLines($text, $lineLength);
    }

    private function getWrappedLines($text, $lineLength)
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

        $followingLines = $this->wrap($remainingText, $lineLength);

        return $firstLine . "\n" . $followingLines;
    }
}
