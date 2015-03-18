<?php
namespace Isign\Sign;

use Isign\ResultInterface;

class ScPrepareResult implements ResultInterface
{
    /** @var string response status */
    private $status;

    /** @var string Data to be signed */
    private $dtbs;

    /** @var string token for sc sign query */
    private $token;

    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
           'status',
           'dtbs',
           'token'
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
     * @return string
     */
    public function getDtbs()
    {
        return $this->dtbs;
    }

    /**
     * @param string $dtbs
     */
    public function setDtbs($dtbs)
    {
        $this->dtbs = $dtbs;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
