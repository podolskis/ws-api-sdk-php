<?php
namespace Dokobit\Tests\Sign;

use Dokobit\QueryInterface;
use Dokobit\Sign\MobileHashStatus;
use Dokobit\Tests\TestCase;

class MobileHashStatusTest extends TestCase
{
    private $method;

    public function setUp(): void
    {
        $this->method = new MobileHashStatus('xxx');
    }

    public function testContainsToken()
    {
        $this->assertInstanceOf('Dokobit\TokenizedQueryInterface', $this->method);
        $this->assertSame('xxx', $this->method->getToken());
    }
    
    public function testItExtendsAbstractStatusClass()
    {
        $this->assertInstanceOf('Dokobit\Login\AbstractStatus', $this->method);
    }

    public function testGetFields()
    {
        $result = $this->method->getFields();

        $this->assertArrayHasKey('token', $result);
        $this->assertSame('xxx', $result['token']);
    }

    public function testGetAction()
    {
        $this->assertSame('mobile/sign/hash/status', $this->method->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::GET, $this->method->getMethod());
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Dokobit\Sign\MobileHashStatusResult', $this->method->createResult());
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
