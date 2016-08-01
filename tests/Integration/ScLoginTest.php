<?php

namespace Isign\Tests\Integration;

use Isign\Login\Sc;
use Isign\Login\ScResult;
use Isign\Login\ScVerify;
use Isign\StatusResultInterface;

class ScLoginTest extends TestCase
{
    /**
     * @return \Isign\StatusResultInterface
     */
    public function testLogin()
    {
        $result = $this->client->get(
            new Sc(base64_encode(CERTIFICATE_LOGIN))
        );

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
    }
}
