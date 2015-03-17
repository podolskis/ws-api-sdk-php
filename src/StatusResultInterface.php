<?php


namespace Isign;

interface StatusResultInterface extends ResultInterface
{
    /**
     * Successful response
     */
    const STATUS_OK = 'ok';

    /**
     * Transaction in progress
     */
    const STATUS_WAITING = 'waiting';

    /**
     * Unexpected error occurred
     */
    const STATUS_UNKNOWN = 'unknown';

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
