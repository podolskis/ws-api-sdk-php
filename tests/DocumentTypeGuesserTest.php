<?php
namespace Dokobit\Tests;

use Dokobit\DocumentTypeGuesser;
use Dokobit\Exception\NotSupportedDocumentType;

class DocumentTypeGuesserTest extends TestCase
{
    public function testPdfGuess()
    {
        $obj = new DocumentTypeGuesser();
        $type = $obj->guess(__DIR__ . '/data/document.pdf');

        $this->assertSame('pdf', $type);
    }

    public function testNoTypeMatch()
    {
        $this->expectException(NotSupportedDocumentType::class);
        $obj = new DocumentTypeGuesser();
        $obj->setGuessers([]);
        $type = $obj->guess(__DIR__ . '/data/document.pdf');

        $this->assertSame(null, $type);
    }
}
