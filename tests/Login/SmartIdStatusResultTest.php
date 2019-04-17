<?php
namespace Dokobit\Tests\Login;

use Dokobit\Login\SmartIdStatusResult;
use Dokobit\QueryInterface;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;
use Dokobit\Tests\Login\SmartIdStatusTest;

class SmartIdStatusResultTest extends TestCase
{
    private $method;
    
    public function setUp()
    {
        $this->method = new SmartIdStatusResult();
    }

    public function testStatusInterface()
    {
        $this->assertInstanceOf('Dokobit\StatusResultInterface', $this->method);
    }
    
    public function testExtendsStatusResultAbstract()
    {
        $this->assertInstanceOf('Dokobit\Login\AbstractStatusResult', $this->method);
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['certificate'],
            ['code'],
            ['country'],
            ['name'],
            ['surname'],
        ];
    }
}
