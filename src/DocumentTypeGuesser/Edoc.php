<?php
namespace Dokobit\DocumentTypeGuesser;

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
