<?php
namespace Isign\Tests\Integration;

use Isign\ResultInterface;
use Isign\Document;

class SealTest extends TestCase
{
    public function testSign()
    {
        /** @var Isign\Document\SealResult $result */
        $result = $this->client->get(new Document\Seal(
            'pdf',
            $this->getDocumentParams(),
            false
        ));

        $this->assertSame(ResultInterface::STATUS_OK, $result->getStatus());
        $this->assertSame('Signature1', $result->getSignatureId());
        $this->assertNotEmpty($result->getFile());

        return $result;
    }

    private function getDocumentParams()
    {
        return [
            'contact' => 'Ponas Testuotojas',
            'reason' => 'Elektroninis spaudas',
            'location' => 'Vilnius',
            'files' => [
               __DIR__ . '/../data/document.pdf',
            ]
        ];
    }
}
