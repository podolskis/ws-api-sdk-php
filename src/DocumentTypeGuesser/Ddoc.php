<?php
namespace Dokobit\DocumentTypeGuesser;

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
