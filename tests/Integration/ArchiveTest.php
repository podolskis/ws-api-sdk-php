<?php
namespace Isign\Tests\Integration;

use Isign\Document\Archive;
use Isign\ResultInterface;
use Isign\StatusResultInterface;

class ArchiveTest extends TestCase
{
    /**
     * @expectedException Isign\Exception\QueryValidator
     */
    public function testRequiredSignatureId()
    {
        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(new Archive(
            'pdf',
            __DIR__ . '/../data/signed.pdf',
            []
        ));
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage File "" does not exist
     */
    public function testRequiredFileParameters()
    {
        try {
            $this->client->get(new Archive(
                'pdf',
                null,
                [
                    ['id' => 'Signature0'],
                    ['id' => 'Signature1']
                ]
            ));
        } catch (\Isign\Exception\QueryValidator $e) {
            $this->assertCount(3, $e->getViolations());
            return;
        }

        $this->fail('Expect exception was not thrown');
    }

    public function testStatusOk()
    {
        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(new Archive(
            'pdf',
            __DIR__ . '/../data/signed.pdf',
            [
                ['id' => 'Signature1']
            ]
        ));

        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
    }
}
