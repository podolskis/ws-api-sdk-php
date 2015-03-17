<?php
namespace Isign\Login;

use Isign\ResultInterface;

class MobileCertificateResult implements ResultInterface
{
    /** @var string response status */
    private $status;

    /** @var string user's first name */
    private $name;

    /** @var string user's last name */
    private $surname;

    /** @var string user's personal code */
    private $code;

    /** @var string user's country */
    private $country;

    /** @var string user's signing certificate */
    private $certificate;

    /** @var  string user's login certificate  */
    private $authCertificate;

    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
            'status',
            'name',
            'surname',
            'code',
            'country',
            'certificate',
            'authCertificate'
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

    /**
     * @return string
     */
    public function getAuthCertificate()
    {
        return $this->authCertificate;
    }

    /**
     * @param string $authCertificate
     */
    public function setAuthCertificate($authCertificate)
    {
        $this->authCertificate = $authCertificate;
    }
}
