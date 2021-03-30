<?php
namespace Dokobit\Document;

use Dokobit\ResultInterface;

class SealResult implements ResultInterface
{
    /** @var string response status */
    private $status;

    /** @var array signed file containing: name, content, digest */
    private $file;

    /** @var string signature id */
    private $signatureId;

    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
            'status',
            'file',
            'signature_id'
        ];
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param array $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getSignatureId()
    {
        return $this->signatureId;
    }

    /**
     * @param string $signatureId
     */
    public function setSignatureId($signatureId)
    {
        $this->signatureId = $signatureId;
    }
}
