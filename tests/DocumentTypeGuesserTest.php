<?php
namespace Dokobit\Tests;

use Dokobit\DocumentTypeGuesser;

class DocumentTypeGuesserTest extends TestCase
{
    public function testPdfGuess()
    {
        $obj = new DocumentTypeGuesser();
        $type = $obj->guess(__DIR__ . '/data/document.pdf');

        $this->assertSame('pdf', $type);
    }

    /**
     * @expectedException Dokobit\Exception\NotSupportedDocumentType
     */
    public function testNoTypeMatch()
    {
        $obj = new DocumentTypeGuesser();
        $obj->setGuessers([]);
        $type = $obj->guess(__DIR__ . '/data/document.pdf');

        $this->assertSame(null, $type);
    }
}
