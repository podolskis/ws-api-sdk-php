<?php
namespace Isign\Tests\Sign;

use Isign\Sign\ScPrepareResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

class PrepareResultTest extends TestCase
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
            ['dtbs'],
            ['token']
        ];
    }
}
