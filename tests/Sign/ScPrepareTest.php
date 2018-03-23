<?php

namespace Isign\Tests\Sign;

use Isign\QueryInterface;
use Isign\Sign\ScPrepare;
use Isign\Tests\TestCase;

class ScPrepareTest extends TestCase
{
    const TYPE = 'pdf';
    const TIMESTAMP = false;
    const LANGUAGE = 'LT';

    /** @var ScPrepare */
    private $method;

    public function setUp()
    {
        $this->method = new ScPrepare(
            base64_encode(CERTIFICATE_SIGN),
            self::TYPE,
            self::TIMESTAMP,
            self::LANGUAGE,
            []
        );
    }

    public function testGetFields()
    {
        $result = $this->method->getFields();

        $this->assertArrayHasKey('certificate', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('timestamp', $result);
        $this->assertArrayHasKey('language', $result);
        $this->assertArrayHasKey($result['type'], $result);
    }

    public function testGetFileFields()
    {
        $method = new ScPrepare(
            base64_encode(CERTIFICATE_SIGN),
            self::TYPE,
            self::TIMESTAMP,
            self::LANGUAGE,
            [
                'files' => [
                    __DIR__.'/../data/document.pdf'
                ]
            ]
        );
        $result = $method->getFields();

        $this->assertArrayHasKey(self::TYPE, $result);
        $this->assertArrayHasKey('files', $result[self::TYPE]);
        $this->assertArrayHasKey(0, $result[self::TYPE]['files']);
        $file = $result[self::TYPE]['files'][0];
        $this->assertArrayHasKey('name', $file);
        $this->assertArrayHasKey('digest', $file);
        $this->assertArrayHasKey('content', $file);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage File "" does not exist
     */
    public function testGetFileFieldsWithNonExistingFile()
    {
        $method = new ScPrepare(
            base64_encode(CERTIFICATE_SIGN),
            self::TYPE,
            self::TIMESTAMP,
            self::LANGUAGE,
            [
                'files' => [
                    null
                ]
            ]
        );
        $method->getFields();
    }

    public function testGetAction()
    {
        $this->assertSame('sc/prepare', $this->method->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::POST, $this->method->getMethod());
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Isign\Sign\ScPrepareResult', $this->method->createResult());
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
