<?php
namespace Dokobit\Tests\Login;

use Dokobit\Login\MobileStatusResult;
use Dokobit\QueryInterface;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class MobileStatusResultTest extends TestCase
{
    private $method;
    
    public function setUp(): void
    {
        $this->method = new MobileStatusResult();
    }
    
    public function testItExtendsAbstractStatusClass()
    {
        $this->assertInstanceOf('Dokobit\Login\AbstractStatusResult', $this->method);
    }

    public function testStatusInterface()
    {
        $this->assertInstanceOf('Dokobit\StatusResultInterface', $this->method);
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
        ];
    }
}
