<?php
namespace Dokobit\Tests\Integration;

use Dokobit\Exception\InvalidData;
use Dokobit\Exception\QueryValidator;
use Dokobit\Login;
use Dokobit\ResultInterface;

class MobileLoginTest extends TestCase
{
    public function testLogin()
    {
        /** @var Login\MobileResult $result */
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

        /** @var Login\MobileStatusResult $statusResult */
        $statusResult = $this->client->get(
            new Login\MobileStatus($result->getToken())
        );
        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
    }

    /**
     * Test parameters validation on client side
     *
     *
     */
    public function testInvalidParamsHandling()
    {
        $this->expectExceptionMessage("Query parameters validation failed");
        $this->expectException(QueryValidator::class);
        $result = $this->client->get(
            new Login\Mobile('3726000000', CODE)
        );
    }

    /**
     * Test parameters validation on API by sending invalid personal code
     */
    public function testBadRequest()
    {
        $this->expectExceptionMessage("Data validation failed");
        $this->expectException(InvalidData::class);
        $result = $this->client->get(
            new Login\Mobile(PHONE, '41001091072')
        );
    }
}
