<?php
namespace Isign\Sign;

use Isign\ResultInterface;

/**
 * Result object for mobile ID login status response.
 */
class MobileStatusResult implements ResultInterface
{
    /** @var string response status */
    private $status;

    /** @var string signature id */
    private $signatureId;

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
            'signature_id',
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
 
    /**
     * Gets the value of signatureId.
     * @return mixed
     */
    public function getSignatureId()
    {
        return $this->signatureId;
    }
 
    /**
     * Sets the value of signatureId.
     * @param mixed $signatureId the signature id
     * @return void
     */
    public function setSignatureId($signatureId)
    {
        $this->signatureId = $signatureId;
    }
}
