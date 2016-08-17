<?php


namespace Isign\Login;

use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

class ScVerifyResultTest extends TestCase
{
    /** @var  ScVerifyResult */
    private $method;

    public function setUp()
    {
        $this->method = new ScVerifyResult();
    }

    public function testStatusInterface()
    {
        $this->assertInstanceOf('Isign\StatusResultInterface', $this->method);
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['name'],
            ['surname'],
            ['code'],
            ['email'],
            ['country'],
        ];
    }
}
