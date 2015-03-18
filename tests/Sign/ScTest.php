<?php
namespace Isign\Tests\Sign;

use Isign\QueryInterface;
use Isign\Sign\Sc;
use Isign\Tests\TestCase;

class ScTest extends TestCase
{
    /** @var  Sc */
    private $query;

    public function setUp()
    {
        $this->query = new Sc('xxxx', 'yyyy');
    }

    public function testGetFields()
    {
        $result = $this->query->getFields();

        $this->assertArrayHasKey('token', $result);
        $this->assertArrayHasKey('signature_value', $result);
        $this->assertSame('xxxx', $result['token']);
        $this->assertSame('yyyy', $result['signature_value']);
    }

    public function testGetAction()
    {
        $this->assertSame('sc/sign', $this->query->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::POST, $this->query->getMethod());
    }

    public function testHasValidationConstraints()
    {
        $collection = $this->query->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Isign\Sign\ScResult', $this->query->createResult());
    }
}
