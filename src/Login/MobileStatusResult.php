<?php
namespace Isign\Login;

use Isign\StatusResultInterface;

/**
 * Result object for mobile ID login status response.
 */
class MobileStatusResult implements StatusResultInterface
{
    /** @var string response status */
    private $status;

    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
            'status',
        ];
    }

    /**
     * Set status
     * @param string $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
