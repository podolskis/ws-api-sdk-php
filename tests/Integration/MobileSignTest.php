<?php
namespace Isign\Tests\Integration;

use Isign\ResultInterface;
use Isign\Sign;

class MobileSignTest extends TestCase
{
    public function testSign()
    {
        /** @var Isign\Sign\MobileResult $result */
        $result = $this->client->get(new Sign\Mobile(
            'pdf',
            PHONE,
            CODE,
            $this->getDocumentParams()
        ));

        $this->assertSame(ResultInterface::STATUS_OK, $result->getStatus());
        $this->assertNotEmpty($result->getControlCode());
        $this->assertNotEmpty($result->getToken());

        return $result;
    }

    /**
     * @depends testSign
     * @params Sign\MobileResult $result
     */
    public function testSignStatusWaiting(Sign\MobileResult $result)
    {
        /** @var Sign\MobileStatusResult $statusResult */
        $statusResult = $this->client->get(
            new Sign\MobileStatus($result->getToken())
        );

        $this->assertSame(ResultInterface::STATUS_WAITING, $statusResult->getStatus());

        return $result;
    }

    /**
     * @depends testSignStatusWaiting
     * @params Sign\MobileResult $result
     */
    public function testSignStatusOk(Sign\MobileResult $result)
    {
        sleep(TIMEOUT);

        /** @var Isign\Login\MobileStatusResult $result */
        $statusResult = $this->client->get(
            new Sign\MobileStatus($result->getToken())
        );
        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
        $this->assertSame('Signature1', $statusResult->getSignatureId());
        $this->assertNotEmpty($statusResult->getFile());
    }

    /**
     * Test parameters validation on client side
     * @expectedException Isign\Exception\QueryValidator
     * @expectedExceptionMessage Query parameters validation failed
     */
    public function testInvalidParamsHandling()
    {
        /** @var Isign\Sign\MobileResult $result */
        $result = $this->client->get(new Sign\Mobile(
            'pdf',
            '37260000007',
            CODE,
            $this->getDocumentParams()
        ));
    }

    /**
     * Test parameters validation on API by sending invalid personal code
     * @expectedException Isign\Exception\InvalidData
     * @expectedExceptionMessage Data validation failed
     */
    public function testBadRequest()
    {
        /** @var Isign\Sign\MobileResult $result */
        $result = $this->client->get(new Sign\Mobile(
            'pdf',
            PHONE,
            '41001091072',
            $this->getDocumentParams()
        ));
    }

    private function getDocumentParams()
    {
        return [
            'contact' => 'Ponas Testuotojas',
            'reason' => 'Dokumento asirašymas',
            'location' => 'Vilnius',
            'files' => [
                __DIR__.'/../data/document.pdf',
            ]
        ];
    }
}
