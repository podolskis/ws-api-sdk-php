<?php
namespace Isign\Tests\Login;

use Isign\Login\MobileCertificateResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

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
            ['signingCertificate'],
            ['authenticationCertificate']
        ];
    }
}
