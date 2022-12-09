<?php


namespace Dokobit\Tests\Document;

use Dokobit\Document\ArchiveResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class ArchiveResultTest extends TestCase
{
    private $method;

    public function setUp(): void
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
