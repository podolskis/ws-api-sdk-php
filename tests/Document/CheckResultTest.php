<?php


namespace Document;

use Dokobit\Document\CheckResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class CheckResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new CheckResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['structure']
        ];
    }
}
