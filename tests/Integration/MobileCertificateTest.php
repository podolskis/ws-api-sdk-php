<?php
namespace Dokobit\Tests\Integration;

use Dokobit\Exception\InvalidData;
use Dokobit\Login;
use Dokobit\ResultInterface;

class MobileCertificateTest extends TestCase
{
    public function testCertificate()
    {
        /** @var Login\MobileCertificateResult $result */
        $result = $this->client->get(
            new Login\MobileCertificate(PHONE, CODE)
        );

        $this->assertEquals(ResultInterface::STATUS_OK, $result->getStatus());
    }

    public function testCertificateInvalidRequest()
    {
        $this->expectException(InvalidData::class);
        $this->client->get(
            new Login\MobileCertificate('+37060000000', CODE)
        );
    }
}
