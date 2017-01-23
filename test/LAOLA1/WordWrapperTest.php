<?php
namespace LAOLA1;

class WordWrapperTest extends \PHPUnit_Framework_TestCase
{
    /** @var WordWrapper */
    private $wordWrapper;

    /**
     * @before
     */
    public function initWordWrapper()
    {
        $this->wordWrapper = new WordWrapper();
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldThrowExceptionOnNegativeLineLength()
    {
        $this->wordWrapper->wrap("", -1);
    }

    /** @test */
    public function shouldReturnEmptyText()
    {
        $this->assertEmpty($this->wordWrapper->wrap("", 5));
    }
}
