<?php
namespace Dokobit\Tests\Login;

use Dokobit\Login\SmartIdCertificateResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class SmartIdCertificateResultTest extends TestCase
{
    private $method;
    
    public function setUp(): void
    {
        $this->method = new SmartIdCertificateResult();
    }

    public function testStatusInterface()
    {
        $this->assertInstanceOf('Dokobit\StatusResultInterface', $this->method);
    }
    
    public function testExtendsStatusResult()
    {
        $this->assertInstanceOf('Dokobit\Login\SmartIdStatusResult', $this->method);
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
