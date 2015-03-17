<?php
namespace Isign\Tests\Integration;


use Isign\Document\Archive;
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
            $this->getFileParams(),
            []
        ));
    }

    public function testRequiredFileParameters()
    {
        try {
            /** @var StatusResultInterface $statusResult */
            $statusResult = $this->client->get(new Archive(
                'pdf',
                [
                    'name' => '',
                    'digest' => '',
                    'content' => '',
                ],
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
            $this->getFileParams(),
            [
                ['id' => 'Signature1']
            ]
        ));

        $this->assertSame(StatusResultInterface::STATUS_OK, $statusResult->getStatus());
    }

    private function getFileParams()
    {
        return [
            'name' => 'signed.pdf',
            'digest' => sha1(file_get_contents(__DIR__.'/../data/signed.pdf')),
            'content' => base64_encode(file_get_contents(__DIR__.'/../data/signed.pdf'))
        ];
    }
}
