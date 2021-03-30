<?php
namespace Dokobit\Tests\Sign;

use Dokobit\QueryInterface;
use Dokobit\Sign\MobileHashResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class MobileHashResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new MobileHashResult();
    }
    
    public function testItExtendsMobileResult()
    {
        $this->assertInstanceOf('Dokobit\Sign\MobileResult', $this->method);
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
