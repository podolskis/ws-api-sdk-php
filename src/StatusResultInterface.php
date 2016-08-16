<?php


namespace Isign;

interface StatusResultInterface extends ResultInterface
{
    /**
     * Get status
     * @return string
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return void
     */
    public function setStatus($status);
}
