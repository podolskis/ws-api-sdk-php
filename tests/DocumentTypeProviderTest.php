<?php
namespace Dokobit\Tests;

use Dokobit\DocumentTypeProvider;

class DocumentTypeProviderTest extends TestCase
{
    public function testGetAllDocumentTypes()
    {
        $ref = new \ReflectionClass('Dokobit\DocumentTypeProvider');
        $this->assertEquals(count($ref->getConstants()), count(DocumentTypeProvider::getAllDocumentTypes()));
    }

    public function testGetPrimaryDocumentTypes()
    {
        $this->assertEquals(7, count(DocumentTypeProvider::getPrimaryDocumentTypes()));
    }
}
