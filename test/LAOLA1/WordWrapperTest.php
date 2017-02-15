<?php
namespace LAOLA1;

class WordWrapperTest extends \PHPUnit_Framework_TestCase
{
    /** @var WordWrapper */
    private $wordWrapper;

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldThrowExceptionOnNegativeLineLength()
    {
        $this->wordWrapper = new WordWrapper();
        $this->wordWrapper->wrap("", -1);
    }

    /** @test */
    public function shouldReturnEmptyText()
    {
        $this->wordWrapper = new WordWrapper();
        $this->assertEmpty($this->wordWrapper->wrap("", 5));
    }

    /** @test */
    public function shouldSplitWordLongerThanLineLength()
    {
        $this->wordWrapper = new WordWrapper();
        $this->assertEquals("Kat\nze", $this->wordWrapper->wrap("Katze", 3));
    }

    /** @test */
    public function shouldSplitWordLongerThanLineLengthMultipleTimes()
    {
        $this->wordWrapper = new WordWrapper();
        $this->assertEquals("irg\nend\nein\ntex\nt", $this->wordWrapper->wrap("irgendeintext", 3));
    }

    /** @test */
    public function shouldSplitPhraseLongerThanLineLengthAtWhitespace()
    {
        $this->wordWrapper = new WordWrapper();
        $this->assertEquals("ich\nprogrammiere", $this->wordWrapper->wrap("ich programmiere", 13));
    }

    /** @test */
    public function shouldSplitPhraseLongerThanLineLengthAtLastWhitespace()
    {
        $this->wordWrapper = new WordWrapper();
        $this->assertEquals(
            "ich programmiere\njetzt weiter",
            $this->wordWrapper->wrap("ich programmiere jetzt weiter", 18)
        );
    }

    /** @test */
    public function shouldNotSplitIfPhraseContainsSpaceAndIsShorterThanLineLength()
    {
        $this->wordWrapper = new WordWrapper();
        $this->assertEquals("ich ein", $this->wordWrapper->wrap("ich ein", 13));
    }

    /** @test */
    public function shouldSplitIfSpaceIsDirectlyBeforeLineLength()
    {
        $this->wordWrapper = new WordWrapper();
        $this->assertEquals("ich\nbin", $this->wordWrapper->wrap("ich bin", 4));
    }

    /** @test */
    public function shouldRemoveSpaceDirectlyAfterLineLength()
    {
        $this->wordWrapper = new WordWrapper();
        $this->assertEquals("ich\nbin", $this->wordWrapper->wrap("ich bin", 3));
    }
}
