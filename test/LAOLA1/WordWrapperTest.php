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

    /** @test */
    public function shouldSplitWordLongerThanLineLength()
    {
        $this->assertEquals("Kat\nze", $this->wordWrapper->wrap("Katze", 3));
    }

    /** @test */
    public function shouldSplitWordLongerThanLineLengthMultipleTimes()
    {
        $this->assertEquals("irg\nend\nein\ntex\nt", $this->wordWrapper->wrap("irgendeintext", 3));
    }

    /** @test */
    public function shouldSplitPhraseLongerThanLineLengthAtWhitespace()
    {
        $this->assertEquals("ich\nprogrammiere", $this->wordWrapper->wrap("ich programmiere", 13));
    }

    /** @test */
    public function shouldSplitPhraseLongerThanLineLengthAtLastWhitespace()
    {
        $this->assertEquals("ich programmiere\njetzt weiter",
            $this->wordWrapper->wrap("ich programmiere jetzt weiter", 18));
    }

    /** @test */
    public function shouldNotSplitIfPhraseContainsSpaceAndIsShorterThanLineLength()
    {
        $this->assertEquals("ich ein",  $this->wordWrapper->wrap("ich ein", 13));
    }
}
