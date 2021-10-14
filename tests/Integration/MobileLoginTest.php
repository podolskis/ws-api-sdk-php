<?php
namespace Dokobit\Tests\Integration;

use Dokobit\Login;
use Dokobit\ResultInterface;

class MobileLoginTest extends TestCase
{
    public function testLogin()
    {
        /** @var Dokobit\Login\MobileResult $result */
        $result = $this->client->get(
            new Login\Mobile(PHONE, CODE)
        );

        $this->assertSame(ResultInterface::STATUS_OK, $result->getStatus());
        $this->assertNotEmpty($result->getCountry());
        $this->assertNotEmpty($result->getCode());
        $this->assertNotEmpty($result->getName());
        $this->assertNotEmpty($result->getSurname());
        $this->assertNotEmpty($result->getCertificate());
        $this->assertNotEmpty($result->getToken());
        $this->assertNotEmpty($result->getControlCode());

        return $result;
    }

    /**
     * @depends testLogin
     * @params Login\MobileResult $result
     */
    public function testLoginStatusOk(Login\MobileResult $result)
    {
        sleep(TIMEOUT);

        /** @var Dokobit\Login\MobileStatusResult $statusResult */
        $statusResult = $this->client->get(
            new Login\MobileStatus($result->getToken())
        );
        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
    }

    /**
     * Test parameters validation on client side
     * @expectedException Dokobit\Exception\QueryValidator
     * @expectedExceptionMessage Query parameters validation failed
     */
    public function testInvalidParamsHandling()
    {
        $result = $this->client->get(
            new Login\Mobile('3726000000', CODE)
        );
    }

    /**
     * Test parameters validation on API by sending invalid personal code
     * @expectedException Dokobit\Exception\InvalidData
     * @expectedExceptionMessage Data validation failed
     */
    public function testBadRequest()
    {
        $result = $this->client->get(
            new Login\Mobile(PHONE, '41001091072')
        );
    }
}
