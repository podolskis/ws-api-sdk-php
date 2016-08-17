<?php
namespace Isign\Tests\Sign;

use Isign\Sign\ScPrepareResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

class ScPrepareResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new ScPrepareResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['algorithm'],
            ['token'],
            ['dtbs'],
            ['dtbs_hash'],
        ];
    }
}
