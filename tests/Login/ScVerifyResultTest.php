<?php


namespace Dokobit\Login;

use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class ScVerifyResultTest extends TestCase
{
    /** @var  ScVerifyResult */
    private $method;

    public function setUp(): void
    {
        $this->method = new ScVerifyResult();
    }

    public function testStatusInterface()
    {
        $this->assertInstanceOf('Dokobit\StatusResultInterface', $this->method);
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
