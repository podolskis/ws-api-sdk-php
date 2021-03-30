<?php
namespace Dokobit\Tests\Integration;

use Dokobit\DocumentTypeGuesser;
use Dokobit\Document\Check;
use Dokobit\ResultInterface;

class CheckTest extends TestCase
{
    /**
     * @expectedException Dokobit\Exception\QueryValidator
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
            /** @var Dokobit\Document\CheckResult $statusResult */
            $statusResult = $this->client->get(
                new Check('pdf', null)
            );
        } catch (\Dokobit\Exception\QueryValidator $e) {
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

        /** @var Dokobit\Document\CheckResult $statusResult */
        $statusResult = $this->client->get(
            new Check($type, $file)
        );

        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
        $this->assertNotEmpty($statusResult->getStructure());
    }
}
