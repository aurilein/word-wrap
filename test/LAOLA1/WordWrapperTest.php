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
        $this->wordWrapper = new WordWrapper(-1);
        $this->wordWrapper->wrap("");
    }

    /** @test */
    public function shouldReturnEmptyText()
    {
        $this->wordWrapper = new WordWrapper(5);
        $this->assertEmpty($this->wordWrapper->wrap(""));
    }

    /** @test */
    public function shouldSplitWordLongerThanLineLength()
    {
        $this->wordWrapper = new WordWrapper(3);
        $this->assertEquals("Kat\nze", $this->wordWrapper->wrap("Katze"));
    }

    /** @test */
    public function shouldSplitWordLongerThanLineLengthMultipleTimes()
    {
        $this->wordWrapper = new WordWrapper(3);
        $this->assertEquals("irg\nend\nein\ntex\nt", $this->wordWrapper->wrap("irgendeintext"));
    }

    /** @test */
    public function shouldSplitPhraseLongerThanLineLengthAtWhitespace()
    {
        $this->wordWrapper = new WordWrapper(13);
        $this->assertEquals("ich\nprogrammiere", $this->wordWrapper->wrap("ich programmiere"));
    }

    /** @test */
    public function shouldSplitPhraseLongerThanLineLengthAtLastWhitespace()
    {
        $this->wordWrapper = new WordWrapper(18);
        $this->assertEquals(
            "ich programmiere\njetzt weiter",
            $this->wordWrapper->wrap("ich programmiere jetzt weiter")
        );
    }

    /** @test */
    public function shouldNotSplitIfPhraseContainsSpaceAndIsShorterThanLineLength()
    {
        $this->wordWrapper = new WordWrapper(13);
        $this->assertEquals("ich ein", $this->wordWrapper->wrap("ich ein"));
    }

    /** @test */
    public function shouldSplitIfSpaceIsDirectlyBeforeLineLength()
    {
        $this->wordWrapper = new WordWrapper(4);
        $this->assertEquals("ich\nbin", $this->wordWrapper->wrap("ich bin"));
    }

    /** @test */
    public function shouldRemoveSpaceDirectlyAfterLineLength()
    {
        $this->wordWrapper = new WordWrapper(3);
        $this->assertEquals("ich\nbin", $this->wordWrapper->wrap("ich bin"));
    }
}
