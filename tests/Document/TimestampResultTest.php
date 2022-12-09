<?php


namespace Dokobit\Tests\Document;


use Dokobit\Document\TimestampResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class TimestampResultTest extends TestCase
{
    private $method;

    public function setUp(): void
    {
        $this->method = new TimestampResult();
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
