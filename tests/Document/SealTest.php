<?php
namespace Isign\Tests\Document;

use Isign\QueryInterface;
use Isign\Document\Seal;
use Isign\Tests\TestCase;

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
            'pdf',
            [
                'files' => [
                    __DIR__.'/../data/document.pdf'
                ]
            ],
            false
        );
        $result = $method->getFields();

        $this->assertArrayHasKey('pdf', $result);
        $this->assertArrayHasKey('files', $result['pdf']);
        $this->assertArrayHasKey(0, $result['pdf']['files']);
        $file = $result['pdf']['files'][0];
        $this->assertArrayHasKey('name', $file);
        $this->assertArrayHasKey('digest', $file);
        $this->assertArrayHasKey('content', $file);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage File "" does not exist
     */
    public function testGetFileFieldsWithNonExistingFile()
    {
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
        $this->assertInstanceOf('Isign\Document\SealResult', $method->createResult());
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
