<?php
namespace Dokobit\Tests\Login;

use Dokobit\Login\SmartIdStatus;
use Dokobit\QueryInterface;
use Dokobit\Tests\TestCase;

class SmartIdStatusTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new SmartIdStatus('xxx');
    }
    
    public function testItExtendsAbstractStatusClass()
    {
        $this->assertInstanceOf('Dokobit\Login\AbstractStatus', $this->method);
    }

    public function testContainsToken()
    {
        $this->assertInstanceOf('Dokobit\TokenizedQueryInterface', $this->method);
        $this->assertSame('xxx', $this->method->getToken());
    }

    public function testGetFields()
    {
        $result = $this->method->getFields();

        $this->assertArrayHasKey('token', $result);
        $this->assertSame('xxx', $result['token']);
    }

    public function testGetAction()
    {
        $this->assertSame('smartid/login/status', $this->method->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::GET, $this->method->getMethod());
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Dokobit\Login\SmartIdStatusResult', $this->method->createResult());
    }

    public function testHasValidationConstraints()
    {
        $collection = $this->method->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }
}
