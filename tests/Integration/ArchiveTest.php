<?php
namespace Dokobit\Tests\Integration;

use Dokobit\Document\Archive;
use Dokobit\Exception\QueryValidator;
use Dokobit\ResultInterface;
use Dokobit\StatusResultInterface;
use RuntimeException;

class ArchiveTest extends TestCase
{
    public function testRequiredSignatureId()
    {
        $this->expectException(QueryValidator::class);
        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(new Archive(
            'pdf',
            __DIR__ . '/../data/signed.pdf',
            []
        ));
    }

    public function testRequiredFileParameters()
    {
        $this->expectExceptionMessage("File \"\" does not exist");
        $this->expectException(RuntimeException::class);
        try {
            $this->client->get(new Archive(
                'pdf',
                null,
                [
                    ['id' => 'Signature0'],
                    ['id' => 'Signature1']
                ]
            ));
        } catch (\Dokobit\Exception\QueryValidator $e) {
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
