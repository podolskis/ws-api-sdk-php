<?php
namespace Dokobit\Tests\Integration;

use Dokobit\Exception\InvalidData;
use Dokobit\Exception\QueryValidator;
use Dokobit\ResultInterface;
use Dokobit\Sign;
use Dokobit\Sign\MobileResult;

class MobileSignTest extends TestCase
{
    public function testSign()
    {
        /** @var MobileResult $result */
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
    public function testSignStatusOk(Sign\MobileResult $result)
    {
        sleep(TIMEOUT);

        /** @var Sign\MobileStatusResult $statusResult */
        $statusResult = $this->client->get(
            new Sign\MobileStatus($result->getToken())
        );
        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
        $this->assertNotEmpty($statusResult->getSignatureId(), 'Signature id is not empty');
        $this->assertArrayHasKey('name', $statusResult->getFile());
        $this->assertArrayHasKey('digest', $statusResult->getFile());
        $this->assertArrayHasKey('content', $statusResult->getFile());
        $this->assertNotEmpty($statusResult->getFile());
    }

    /**
     * Test parameters validation on client side
     */
    public function testInvalidParamsHandling()
    {
        $this->expectExceptionMessage("Query parameters validation failed");
        $this->expectException(QueryValidator::class);
        /** @var MobileResult $result */
        $result = $this->client->get(new Sign\Mobile(
            'pdf',
            '37260000007',
            CODE,
            $this->getDocumentParams()
        ));
    }

    /**
     * Test parameters validation on API by sending invalid personal code
     */
    public function testBadRequest()
    {
        $this->expectExceptionMessage("Data validation failed");
        $this->expectException(InvalidData::class);
        /** @var MobileResult $result */
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
