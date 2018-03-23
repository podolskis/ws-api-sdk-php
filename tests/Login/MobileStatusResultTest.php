<?php
namespace Isign\Tests\Login;

use Isign\Login\MobileStatusResult;
use Isign\QueryInterface;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

class MobileStatusResultTest extends TestCase
{
    private $method;
    
    public function setUp()
    {
        $this->method = new MobileStatusResult();
    }
    
    public function testItExtendsAbstractStatusClass()
    {
        $this->assertInstanceOf('Isign\Login\AbstractStatusResult', $this->method);
    }

    public function testStatusInterface()
    {
        $this->assertInstanceOf('Isign\StatusResultInterface', $this->method);
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
        ];
    }
}
