<?php
namespace Isign\Sign;

use Isign\ResultInterface;

/**
 * Result object for mobile ID login status response.
 */
class MobileStatusResult implements ResultInterface
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

    /** @var string response status */
    private $status;

    /** @var array signed document file */
    private $file = array();

    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
            'status',
            'file'
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

    /**
     * Gets the value of file.
     * @return array
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets the value of file.
     * @param array $file the file
     * @return void
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
}
