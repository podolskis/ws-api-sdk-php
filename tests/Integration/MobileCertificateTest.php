<?php
namespace Isign\Tests\Integration;

use Isign\Login;
use Isign\ResultInterface;

class MobileCertificateTest extends TestCase
{
    public function testCertificate()
    {
        /** @var Isign\Login\MobileCertificateResult $result */
        $result = $this->client->get(
            new Login\MobileCertificate(PHONE, CODE)
        );

        return $result;
    }

    /**
     * @expectedException Isign\Exception\InvalidData
     */
    public function testCertificateInvalidRequest()
    {
        /** @var Isign\Login\MobileCertificateResult $result */
        $result = $this->client->get(
            new Login\MobileCertificate('+37060000000', CODE)
        );

        return $result;
    }
}
