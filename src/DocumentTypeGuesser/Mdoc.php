<?php
namespace Dokobit\DocumentTypeGuesser;

class Mdoc implements DocumentTypeGuesserInterface
{
    public function guess($content, $extension)
    {
        if ($extension != 'mdoc') {
            return;
        }

        return 'mdoc';
    }
}
