<?php

namespace Dokobit\Tests\Integration;

use Dokobit\Login\Sc;
use Dokobit\Login\ScResult;
use Dokobit\Login\ScVerify;
use Dokobit\StatusResultInterface;

class ScLoginTest extends TestCase
{
    /**
     * @return \Dokobit\StatusResultInterface
     */
    public function testLogin()
    {
        $result = $this->client->get(
            new Sc(base64_encode(CERTIFICATE_LOGIN))
        );

        $this->assertSame(StatusResultInterface::STATUS_OK, $result->getStatus());
        $this->assertNotEmpty($result->getDtbs());
        $this->assertNotEmpty($result->getToken());
        $this->assertNotEmpty($result->getName());
        $this->assertNotEmpty($result->getSurname());
        $this->assertEmpty($result->getCode());
        $this->assertNotEmpty($result->getCountry());
        $this->assertNotEmpty($result->getEmail());
        $this->assertNotEmpty($result->getCertificate());
        $this->assertSame('sha256', $result->getAlgorithm());

        return $result;
    }

    /**
     * @depends testLogin
     * @param ScResult $result
     */
    public function testVerifyStatusOk(ScResult $result)
    {
        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(
            new ScVerify($result->getToken(), $this->sign($result->getDtbs(), PRIVATE_KEY_LOGIN))
        );

        $this->assertSame(StatusResultInterface::STATUS_OK, $statusResult->getStatus());
        $this->assertNotEmpty($statusResult->getName());
        $this->assertNotEmpty($statusResult->getSurname());
        $this->assertEmpty($statusResult->getCode());
        $this->assertNotEmpty($statusResult->getEmail());
        $this->assertNotEmpty($statusResult->getCountry());
    }
}
