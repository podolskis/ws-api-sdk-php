<?php
namespace Dokobit\DocumentTypeGuesser;

interface DocumentTypeGuesserInterface
{
    public function guess($content, $extension);
}
