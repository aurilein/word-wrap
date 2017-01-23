<?php
namespace LAOLA1;

class WordWrapperTest extends \PHPUnit_Framework_TestCase
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

    /** @test */
    public function shouldReturnEmptyText()
    {
        $wordWrapper = new WordWrapper();
        $this->assertEmpty($wordWrapper->wrap("", 5));
    }
}
