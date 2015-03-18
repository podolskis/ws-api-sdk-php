<?php


namespace Isign\Tests\Document;


use Isign\Document\ArchiveResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

class ArchiveResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new ArchiveResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['file']
        ];
    }
}
