<?php
namespace Dokobit\Tests\Sign;

use Dokobit\QueryInterface;
use Dokobit\Sign\MobileResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class MobileResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new MobileResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['control_code'],
            ['token']
        ];
    }
}
