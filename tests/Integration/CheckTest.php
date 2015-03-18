<?php
namespace Isign\Tests\Integration;


use Isign\Document\Check;
use Isign\StatusResultInterface;

class CheckTest extends TestCase
{
    /**
     * @expectedException Isign\Exception\QueryValidator
     */
    public function testRequiredParams()
    {
        $this->client->get(new Check(
            null,
            $this->getFileParams()
        ));
    }

    public function testRequiredFileParameters()
    {
        try {
            /** @var StatusResultInterface $statusResult */
            $statusResult = $this->client->get(new Check(
                'pdf',
                [
                    'name' => '',
                    'digest' => '',
                    'content' => '',
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
        $statusResult = $this->client->get(new Check('pdf', $this->getFileParams()));

        $this->assertSame(StatusResultInterface::STATUS_OK, $statusResult->getStatus());
    }

    private function getFileParams()
    {
        $content = file_get_contents(__DIR__.'/../data/document.pdf');

        return [
            'name' => 'document.pdf',
            'digest' => sha1($content),
            'content' => base64_encode($content)
        ];
    }
}
