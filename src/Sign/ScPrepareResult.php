<?php
namespace Dokobit\Sign;

use Dokobit\ResultInterface;

class ScPrepareResult implements ResultInterface
{
    /** @var string response status */
    private $status;

    /** @var string signature algorithm */
    private $algorithm;

    /** @var string token for sc sign query */
    private $token;

    /** @var string sha256 hash of data to be signed */
    private $dtbsHash;

    /** @var string Data to be signed */
    private $dtbs;

    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
           'status',
           'algorithm',
           'token',
           'dtbs_hash',
           'dtbs',
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
 
    /**
     * Gets the value of algorithm.
     * @return mixed
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }
 
    /**
     * Sets the value of algorithm.
     * @param mixed $algorithm the algorithm
     * @return void
     */
    public function setAlgorithm($algorithm)
    {
        $this->algorithm = $algorithm;
    }
 
    /**
     * Gets the value of dtbsHash.
     * @return mixed
     */
    public function getDtbsHash()
    {
        return $this->dtbsHash;
    }
 
    /**
     * Sets the value of dtbsHash.
     * @param mixed $dtbsHash the dtbs hash
     * @return void
     */
    public function setDtbsHash($dtbsHash)
    {
        $this->dtbsHash = $dtbsHash;
    }
}
