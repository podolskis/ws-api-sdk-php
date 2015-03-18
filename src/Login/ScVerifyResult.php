<?php


namespace Isign\Login;

use Isign\StatusResultInterface;

class ScVerifyResult implements StatusResultInterface
{
    /** @var   */
    private $status;
    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
            'status'
        ];
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
