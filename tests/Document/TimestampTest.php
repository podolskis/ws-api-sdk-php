<?php


namespace Dokobit\Tests\Document;

use Dokobit\Document\Timestamp;
use Dokobit\QueryInterface;
use Dokobit\Tests\TestCase;

class TimestampTest extends TestCase
{
    const TYPE = 'pdf';
    const NAME = 'signed.pdf';

    /** @var  Check */
    private $query;

    public function setUp(): void
    {
        $this->query = new Timestamp(
            self::TYPE,
            __DIR__ . '/../data/signed.pdf'
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

        $this->assertSame(self::TYPE, $fields['type']);
        $this->assertSame(self::NAME, $fields['file']['name']);
    }

    public function testGetFileFieldsWithNonExistingFile()
    {
        $this->expectExceptionMessage("File \"\" does not exist");
        $this->expectException(\RuntimeException::class);
        $method = new Timestamp(self::TYPE, '');
        $method->getFields();
    }

    public function testGetAction()
    {
        $this->assertSame('timestamp', $this->query->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::POST, $this->query->getMethod());
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Dokobit\Document\TimestampResult', $this->query->createResult());
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
