<?php
namespace Dokobit;

/**
 * Interface defines queries using token as resource identificator.
 */
interface TokenizedQueryInterface extends QueryInterface
{
    /**
     * Get unique resource identifier, received from mobile login request
     * @return string
     */
    public function getToken();
}
