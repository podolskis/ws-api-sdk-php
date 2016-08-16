<?php
namespace Isign\DocumentTypeGuesser;

class Ddoc implements DocumentTypeGuesserInterface
{
    public function guess($content, $extension)
    {
        if ($extension != 'ddoc') {
            return;
        }

        return 'ddoc';
    }
}
