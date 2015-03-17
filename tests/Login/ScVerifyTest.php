<?php


namespace Isign\Login;

use Isign\QueryInterface;
use Isign\Tests\TestCase;

class ScStatusTest extends TestCase
{
    /** @var  ScVerify */
    private $method;

    public function setUp()
    {
        $this->method = new ScVerify('xxx', 'yyy');
    }

    public function testContainsToken()
    {
        $this->assertInstanceOf('Isign\QueryInterface', $this->method);
        $this->assertSame('xxx', $this->method->getToken());
    }

    public function testContainsSignatureValue()
    {
        $this->assertSame('yyy', $this->method->getSignatureValue());
    }

    public function testGetAction()
    {
        $this->assertSame('sc/login/verify', $this->method->getAction());
    }

    public function testGetFields()
    {
        $method = new ScVerify('xxx', 'yyy');

        $result = $method->getFields();

        $this->assertArrayHasKey('token', $result);
        $this->assertArrayHasKey('signature_value', $result);
        $this->assertSame('xxx', $result['token']);
        $this->assertSame('yyy', $result['signature_value']);
    }

    public function testCreateResult()
    {
        $method = new ScVerify('xxx', 'yyy');
        $this->assertInstanceOf('Isign\Login\ScVerifyResult', $method->createResult());
    }

    public function testGetValidationConstraints()
    {
        $method = new ScVerify('xxx', 'yyy');

        $collection = $method->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }

    public function testGetMethod()
    {
        $method = new ScVerify('xxx', 'yyy');
        $this->assertSame(QueryInterface::POST, $method->getMethod());
    }
}
