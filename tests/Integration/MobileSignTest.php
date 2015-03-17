<?php
namespace Isign\Tests\Integration;

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

        $this->assertSame(Sign\MobileStatusResult::STATUS_WAITING, $statusResult->getStatus());

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
        $this->assertSame(Sign\MobileStatusResult::STATUS_OK, $statusResult->getStatus());
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
                [
                    'name' => 'Signing.pdf',
                    'content' => base64_encode(file_get_contents(__DIR__ . '/../data/document.pdf')),
                    'digest' => sha1_file(__DIR__ . '/../data/document.pdf')
                ]
            ]
        ];
    }
}
