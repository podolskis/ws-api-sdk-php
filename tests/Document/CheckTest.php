<?php


namespace Isign\Tests\Document;

use Isign\Document\Check;
use Isign\QueryInterface;
use Isign\Tests\TestCase;

class CheckTest extends TestCase
{
    const TYPE = 'pdf';
    const NAME = 'document.pdf';

    /** @var  Check */
    private $query;

    public function setUp()
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

        $this->assertSame(self::TYPE, $fields['type']);
        $this->assertSame(self::NAME, $fields['file']['name']);
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
        $this->assertInstanceOf('Isign\Document\CheckResult', $this->query->createResult());
    }
}
