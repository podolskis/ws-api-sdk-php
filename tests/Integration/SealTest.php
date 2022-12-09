<?php
namespace Dokobit\Tests\Integration;

use Dokobit\ResultInterface;
use Dokobit\Document;

class SealTest extends TestCase
{
    public function testSign()
    {
        /** @var Document\SealResult $result */
        $result = $this->client->get(new Document\Seal(
            'pdf',
            $this->getDocumentParams(),
            false
        ));

        $this->assertSame(ResultInterface::STATUS_OK, $result->getStatus());
        $this->assertNotNull($result->getSignatureId());
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
