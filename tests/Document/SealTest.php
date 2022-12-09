<?php
namespace Dokobit\Tests\Document;

use Dokobit\QueryInterface;
use Dokobit\Document\Seal;
use Dokobit\Tests\TestCase;

class SealTest extends TestCase
{
    public function testGetFields()
    {
        $document = $this->getPdfDocument();

        $method = new Seal('pdf', $document, false);

        $result = $method->getFields();

        $this->assertSame('pdf', $result['type']);
        $this->assertSame($document, $result['pdf']);
        $this->assertSame(false, $result['timestamp']);
    }

    public function testGetFileFields()
    {
        $method = new Seal(
            'asic',
            [
                'files' => [
                    [
                        'name' => 'filename.pdf',
                        'digest' => 'some digest',
                        'content' => 'some content'
                    ],
                    __DIR__.'/../data/document.pdf'
                ]
            ],
            false
        );
        $result = $method->getFields();

        $this->assertArrayHasKey('asic', $result);
        $this->assertArrayHasKey('files', $result['asic']);
        $this->assertArrayHasKey(0, $result['asic']['files']);
        $file0 = $result['asic']['files'][0];
        $this->assertArrayHasKey('name', $file0);
        $this->assertArrayHasKey('digest', $file0);
        $this->assertArrayHasKey('content', $file0);
        $this->assertArrayHasKey(1, $result['asic']['files']);
        $file1 = $result['asic']['files'][1];
        $this->assertArrayHasKey('name', $file1);
        $this->assertArrayHasKey('digest', $file1);
        $this->assertArrayHasKey('content', $file1);
    }

    public function testGetFileFieldsWithNonExistingFile()
    {
        $this->expectExceptionMessage("File \"\" does not exist");
        $this->expectException(\RuntimeException::class);
        $method = new Seal(
            'pdf',
            [
                'files' => [
                    ''
                ]
            ],
            false
        );
        $method->getFields();
    }

    public function testGetAction()
    {
        $method = new Seal('', [], false);
        $this->assertSame('seal', $method->getAction());
    }

    public function testGetMethod()
    {
        $method = new Seal('', [], false);
        $this->assertSame(QueryInterface::POST, $method->getMethod());
    }

    public function testCreateResult()
    {
        $method = new Seal('', [], false);
        $this->assertInstanceOf('Dokobit\Document\SealResult', $method->createResult());
    }

    public function testHasValidationConstraints()
    {
        $method = new Seal('', [], false);
        $collection = $method->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }

    private function getPdfDocument()
    {
        return [
            'signing_purpose' => '',
            'contact' => '',
            'reason' => '',
            'location' => '',
            'files' => [],
        ];
    }
}
