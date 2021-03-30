<?php
namespace Dokobit\Tests\Login;

use Dokobit\Login\MobileCertificate;
use Dokobit\QueryInterface;
use Dokobit\Tests\TestCase;

class MobileCertificateTest extends TestCase
{
    private $query;

    public function setUp()
    {
        $this->query = new MobileCertificate('+370xxxxxxxx', 'xxxxxxxxxxx');
    }

    public function testGetFields()
    {
        $result = $this->query->getFields();

        $this->assertArrayHasKey('phone', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertSame('+370xxxxxxxx', $result['phone']);
        $this->assertSame('xxxxxxxxxxx', $result['code']);
    }

    public function testGetAction()
    {
        $this->assertSame('mobile/certificate', $this->query->getAction());
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
        $this->assertInstanceOf('Dokobit\Login\MobileCertificateResult', $this->query->createResult());
    }
}
