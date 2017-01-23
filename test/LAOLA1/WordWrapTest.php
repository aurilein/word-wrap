<?php
namespace LAOLA1;

class WordWrapTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldThrowExceptionOnNegativeLineLength()
    {
        $wordWrapper = new WordWrapper();
        $wordWrapper->wrap("", -1);
    }
}
