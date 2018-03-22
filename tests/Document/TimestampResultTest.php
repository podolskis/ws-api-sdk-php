<?php


namespace Isign\Tests\Document;


use Isign\Document\TimestampResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

class TimestampResultTest extends TestCase
{
    private $method;

    public function setUp()
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
