<?php
namespace Isign\DocumentTypeGuesser;

class Pdflt implements DocumentTypeGuesserInterface
{
    public function guess($content, $extension)
    {
        if ($extension != 'pdf') {
            return;
        }

        return 'pdflt';
    }
}
