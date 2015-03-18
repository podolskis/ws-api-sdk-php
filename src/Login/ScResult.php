<?php


namespace Isign\Login;

use Isign\ResultInterface;

class ScResult implements ResultInterface
{
    /** @var string response status */
    private $status;
    /** @var string hash which needs to be signed */
    private $dtbs;
    /** @var string session token */
    private $token;
    /** @var string user's first name */
    private $name;
    /** @var string user's last name */
    private $surname;
    /** @var string user's personal code */
    private $code;
    /** @var string user's country */
    private $country;
    /** @var string user's login certificate */
    private $certificate;
    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
            'status',
            'dtbs',
            'token',
            'name',
            'surname',
            'code',
            'country',
            'certificate'
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * @param string $certificate
     */
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;
    }
}
