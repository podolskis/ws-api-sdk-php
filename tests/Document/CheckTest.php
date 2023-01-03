<?php


namespace Dokobit\Tests\Document;

use Dokobit\Document\Check;
use Dokobit\QueryInterface;
use Dokobit\Tests\TestCase;

class CheckTest extends TestCase
{
    const TYPE = 'pdf';
    const NAME = 'document.pdf';

    /** @var  Check */
    private $query;

    public function setUp(): void
    {
        $this->query = new Check(
            self::TYPE,
            __DIR__.'/../data/document.pdf'
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
        $this->assertArrayHasKey('validation_policy', $fields);

        $this->assertSame(self::TYPE, $fields['type']);
        $this->assertSame(self::NAME, $fields['file']['name']);
        $this->assertSame('qes', $fields['validation_policy']);
    }

    public function testGetFileFieldsWithNonExistingFile()
    {
        $this->expectExceptionMessage("File \"\" does not exist");
        $this->expectException(\RuntimeException::class);
        $method = new Check(self::TYPE, null);
        $method->getFields();
    }

    public function testGetAction()
    {
        $this->assertSame('check', $this->query->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::POST, $this->query->getMethod());
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Dokobit\Document\CheckResult', $this->query->createResult());
    }

    public function testHasValidationConstraints()
    {
        $collection = $this->query->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }

    public function testGetValidationPolicies()
    {
        $this->assertSame(['qes', 'aes'], $this->query->getValidationPolicies());
    }
}
