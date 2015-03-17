<?php
namespace Isign\Tests\Login;

use Isign\Login\Mobile;
use Isign\QueryInterface;
use Isign\Tests\TestCase;

class MobileTest extends TestCase
{
    public function testGetFields()
    {
        $method = new Mobile('+370xxxxxxxx', 'xxxxxxxxxxx');
        
        $result = $method->getFields();

        $this->assertArrayHasKey('phone', $result);
        $this->assertSame('+370xxxxxxxx', $result['phone']);
        $this->assertSame('xxxxxxxxxxx', $result['code']);
    }

    public function testGetFieldsShouldSkipOptional()
    {
        $method = new Mobile('+370xxxxxxxx', 'xxxxxxxxxxx');
        
        $result = $method->getFields();
        $this->assertArrayNotHasKey('language', $result);
        $this->assertArrayNotHasKey('message', $result);
    }

    public function testGetFieldsIncludesOptional()
    {
        $method = new Mobile('+370xxxxxxxx', 'xxxxxxxxxxx', 'LT', 'Labas');
        
        $result = $method->getFields();
        $this->assertSame('LT', $result['language']);
        $this->assertSame('Labas', $result['message']);
    }

    public function testGetAction()
    {
        $method = new Mobile('', '');
        $this->assertSame('mobile/login', $method->getAction());
    }

    public function testGetMethod()
    {
        $method = new Mobile('', '');
        $this->assertSame(QueryInterface::POST, $method->getMethod());
    }

    public function testCreateResult()
    {
        $method = new Mobile('', '');
        $this->assertInstanceOf('Isign\Login\MobileResult', $method->createResult());
    }

    public function testHasValidationConstraints()
    {
        $method = new Mobile('', '');
        $collection = $method->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }
}
