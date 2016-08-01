<?php
namespace Isign\DocumentTypeGuesser;

class Bdoc implements DocumentTypeGuesserInterface
{
    public function guess($content, $extension)
    {
        if ($extension != 'bdoc') {
            return;
        }

        return 'bdoc';
    }
}
