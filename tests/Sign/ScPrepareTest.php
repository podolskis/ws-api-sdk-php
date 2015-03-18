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

    /** @var  Prepare */
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
}
