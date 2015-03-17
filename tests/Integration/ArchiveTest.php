<?php
namespace Isign\Tests\Integration;


use Isign\Document\Archive;
use Isign\StatusResultInterface;

class ArchiveTest extends TestCase
{
    public function testStatusOk()
    {
        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(new Archive(
            'pdf',
            [
                'name' => 'signed.pdf',
                'digest' => sha1(file_get_contents(__DIR__.'/../data/signed.pdf')),
                'content' => base64_encode(file_get_contents(__DIR__.'/../data/signed.pdf'))
            ],
            [
                ['id' => 'sig1']
            ]
        ));

        $this->assertSame(StatusResultInterface::STATUS_OK, $statusResult->getStatus());
    }
}
