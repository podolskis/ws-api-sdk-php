<?php
namespace Isign\Tests\Integration;


use Isign\Document\Check;
use Isign\StatusResultInterface;

class CheckTest extends TestCase
{
    public function testStatusOk()
    {
        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(new Check('pdf', [
            'name' => 'document.pdf',
            'digest' => sha1(file_get_contents(__DIR__.'/../data/document.pdf')),
            'content' => base64_encode(file_get_contents(__DIR__.'/../data/document.pdf'))
        ]));

        $this->assertSame(StatusResultInterface::STATUS_OK, $statusResult->getStatus());
    }


    public function testFileValidation()
    {
        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(new Check('pdf', [
            'name' => 'document.pdf',
            'digest' => 'RANDOM_WROND_DIGEST',
            'content' => base64_encode(file_get_contents(__DIR__.'/../data/document.pdf'))
        ]));

        $this->assertSame(StatusResultInterface::STATUS_OK, $statusResult->getStatus());
    }
}
