<?php


namespace Document;

use Isign\Document\CheckResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

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
