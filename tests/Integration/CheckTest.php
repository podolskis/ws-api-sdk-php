<?php
namespace Dokobit\Tests\Integration;

use Dokobit\Document\CheckResult;
use Dokobit\DocumentTypeGuesser;
use Dokobit\Document\Check;
use Dokobit\Exception\QueryValidator;
use Dokobit\ResultInterface;

class CheckTest extends TestCase
{
    public function testRequiredParams()
    {
        $this->expectException(QueryValidator::class);
        $this->client->get(new Check(
            null,
            __DIR__.'/../data/document.pdf'
        ));
    }

    public function testRequiredFileParameters()
    {
        $this->expectExceptionMessage("File \"\" does not exist");
        $this->expectException(\RuntimeException::class);
        try {
            /** @var CheckResult $statusResult */
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

        /** @var CheckResult $statusResult */
        $statusResult = $this->client->get(
            new Check($type, $file, Check::VALIDATION_POLICY_AES)
        );

        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
        $this->assertNotEmpty($statusResult->getStructure());
    }
}
