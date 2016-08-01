<?php
namespace Isign\Tests\Integration;


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
        /** @var StatusResultInterface $statusResult */
        $statusResult = $this->client->get(
            new Check('pdf', __DIR__.'/../data/signed.pdf')
        );

        $this->assertSame(ResultInterface::STATUS_OK, $statusResult->getStatus());
    }
}
