<?php


namespace Isign\Tests\Document;

use Isign\Document\Archive;
use Isign\Document\Check;
use Isign\QueryInterface;
use Isign\Tests\TestCase;

class ArchiveTest extends TestCase
{
    const TYPE = 'pdf';
    const NAME = 'document.pdf';

    /** @var  Check */
    private $query;

    public function setUp()
    {
        $this->query = new Archive(
            self::TYPE,
            __DIR__ . '/../data/document.pdf',
            [
                ['id' => 'signature_0'],
                ['id' => 'signature_1']
            ]
        );
    }

    public function testGetFields()
    {
        $fields = $this->query->getFields();

        $this->assertArrayHasKey('type', $fields);
        $this->assertArrayHasKey('file', $fields);
        $this->assertArrayHasKey('name', $fields['file']);
        $this->assertArrayHasKey('digest', $fields['file']);
        $this->assertArrayHasKey('content', $fields['file']);
        $this->assertArrayHasKey('id', $fields['signatures'][0]);

        $this->assertSame(self::TYPE, $fields['type']);
        $this->assertSame(self::NAME, $fields['file']['name']);
        $this->assertSame('signature_0', $fields['signatures'][0]['id']);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage File "" does not exist
     */
    public function testGetFileFieldsWithNonExistingFile()
    {
        $method = new Archive(self::TYPE, null, []);
        $method->getFields();
    }

    public function testGetAction()
    {
        $this->assertSame('archive', $this->query->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::POST, $this->query->getMethod());
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Isign\Document\ArchiveResult', $this->query->createResult());
    }

    public function testHasValidationConstraints()
    {
        $collection = $this->query->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }
}
