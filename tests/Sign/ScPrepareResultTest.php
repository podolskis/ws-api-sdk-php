<?php
namespace Dokobit\Tests\Sign;

use Dokobit\Sign\ScPrepareResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

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
