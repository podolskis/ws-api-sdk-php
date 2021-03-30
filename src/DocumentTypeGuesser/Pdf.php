<?php
namespace Dokobit\DocumentTypeGuesser;

class Pdf implements DocumentTypeGuesserInterface
{
    public function guess($content, $extension)
    {
        if ($extension != 'pdf') {
            return;
        }

        return 'pdf';
    }
}
