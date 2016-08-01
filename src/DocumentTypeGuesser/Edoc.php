<?php
namespace Isign\DocumentTypeGuesser;

class Edoc implements DocumentTypeGuesserInterface
{
    public function guess($content, $extension)
    {
        if ($extension != 'edoc') {
            return;
        }

        return 'edoc';
    }
}
