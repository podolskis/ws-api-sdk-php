<?php

namespace Isign;

use Isign\DocumentTypeGuesser;
use Isign\Exception\NotSupportedDocumentType;

/**
 * Guesses document type
 */
class DocumentTypeGuesser
{
    private $guessers;

    public function __construct()
    {
        $this->guessers = [
            // new DocumentTypeGuesser\Pdflt(), // Pdflt must be loaded before PDF
            new DocumentTypeGuesser\Pdf(),
            new DocumentTypeGuesser\Adoc(),
            new DocumentTypeGuesser\Bdoc(),
            new DocumentTypeGuesser\Ddoc(),
            new DocumentTypeGuesser\Edoc(),
            new DocumentTypeGuesser\Mdoc(),
        ];
    }

    public function setGuessers(array $guessers)
    {
        $this->guessers = $guessers;
    }

    public function guess($path)
    {
        $extension = $this->getExtension($path);
        $content = file_get_contents($path);

        $type = null;
        foreach ($this->guessers as $guesser) {
            if ($type = $guesser->guess($content, $extension)) {
                break;
            }
        }

        if ($type === null) {
            throw new NotSupportedDocumentType('Document type is not supported');
        }

        return $type;
    }

    private function getExtension($path)
    {
        $parts = explode('.', strtolower(pathinfo($path, PATHINFO_EXTENSION)));
        return trim(end($parts));
    }
}
