<?php
namespace Isign;

/**
 * Result interface for building result objects.
 */
interface ResultInterface
{
    /**
     * Fields expected in response
     * @return array
     */
    public function getFields();
}
