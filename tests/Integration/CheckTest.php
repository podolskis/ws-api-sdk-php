<?php
namespace Isign\Tests\Integration;


use Isign\DocumentTypeGuesser;
use Isign\Document\Check;
use Isign\ResultInterface;
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
            __DIR__.'/../data/document.pdf'
        ));
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage File "" does not exist
     */
    public function testRequiredFileParameters()
    {
        try {
            /** @var StatusResultInterface $statusResult */
            $statusResult = $this->client->get(
                new Check('pdf', null)
            );
        } catch (\Isign\Exception\QueryValidator $e) {
            $this->assertCount(3, $e->getViolations());
            return;
        }

        $this->fail('Expect exception was not thrown');
    }

    public function testStatusOk()
    {
        $file = __DIR__.'/../data/signed.pdf';

        $guesser = new DocumentTypeGuesser();
        $type = $guesser->guess($file);

        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(
            new Check($type, $file)
        );

        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
    }
}
