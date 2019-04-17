<?php
namespace Dokobit\Tests\Login;

use Dokobit\Login\MobileCertificateResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class MobileCertificateResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new MobileCertificateResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['name'],
            ['surname'],
            ['code'],
            ['country'],
            ['signing_certificate'],
            ['authentication_certificate']
        ];
    }
}
