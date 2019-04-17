<?php
namespace Dokobit\Tests\Integration;

use Dokobit\Login;
use Dokobit\ResultInterface;

class MobileCertificateTest extends TestCase
{
    public function testCertificate()
    {
        /** @var Dokobit\Login\MobileCertificateResult $result */
        $result = $this->client->get(
            new Login\MobileCertificate(PHONE, CODE)
        );

        return $result;
    }

    /**
     * @expectedException Dokobit\Exception\InvalidData
     */
    public function testCertificateInvalidRequest()
    {
        /** @var Dokobit\Login\MobileCertificateResult $result */
        $result = $this->client->get(
            new Login\MobileCertificate('+37060000000', CODE)
        );

        return $result;
    }
}
