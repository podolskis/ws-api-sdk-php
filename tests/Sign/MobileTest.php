<?php
namespace Isign\Tests\Sign;

use Isign\Sign\Mobile;
use Isign\QueryInterface;
use Isign\Tests\TestCase;

class MobileTest extends TestCase
{
    public function testGetFields()
    {
        $document = $this->getPdfDocument();

        $method = new Mobile(
            'pdf',
            '+370xxxxxxxx',
            'xxxxxxxxxxx',
            $document
        );
        
        $result = $method->getFields();

        $this->assertSame('pdf', $result['type']);
        $this->assertSame('+370xxxxxxxx', $result['phone']);
        $this->assertSame('xxxxxxxxxxx', $result['code']);
        $this->assertSame($document, $result['pdf']);
    }

    public function testGetFieldsShouldSkipOptional()
    {
        $method = new Mobile('pdf', '+370xxxxxxxx', 'xxxxxxxxxxx', $this->getPdfDocument());

        $result = $method->getFields();
        $this->assertArrayNotHasKey('language', $result);
        $this->assertArrayNotHasKey('message', $result);
        $this->assertArrayNotHasKey('timestamp', $result);
    }

    public function testGetFieldsIncludesOptional()
    {
        $method = new Mobile('pdf', '+370xxxxxxxx', 'xxxxxxxxxxx', $this->getPdfDocument(), 'LT', 'Labas', false);
        
        $result = $method->getFields();
        $this->assertSame('LT', $result['language']);
        $this->assertSame('Labas', $result['message']);
        $this->assertSame(false, $result['timestamp']);
    }

    public function testGetAction()
    {
        $method = new Mobile('', '', '', []);
        $this->assertSame('mobile/sign', $method->getAction());
    }

    public function testGetMethod()
    {
        $method = new Mobile('', '', '', []);
        $this->assertSame(QueryInterface::POST, $method->getMethod());
    }

    public function testCreateResult()
    {
        $method = new Mobile('', '', '', []);
        $this->assertInstanceOf('Isign\Sign\MobileResult', $method->createResult());
    }

    public function testHasValidationConstraints()
    {
        $method = new Mobile('', '', '', []);
        $collection = $method->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }

    private function getPdfDocument()
    {
        return [
            'signing_purpose' => '',
            'contact' => '',
            'reason' => '',
            'location' => '',
            'files' => [
                [
                    'name' => '',
                    'content' => '',
                    'digest' => '',
                ]
            ],
        ];
    }
}
