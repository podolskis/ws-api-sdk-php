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
    private $signingCertificate;

    /** @var  string user's login certificate  */
    private $authenticationCertificate;

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
            'signing_certificate',
            'authentication_certificate'
        ];
    }
 
    /**
     * Gets the value of status.
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
 
    /**
     * Sets the value of status.
     * @param mixed $status the status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
 
    /**
     * Gets the value of name.
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
 
    /**
     * Sets the value of name.
     * @param mixed $name the name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
 
    /**
     * Gets the value of surname.
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }
 
    /**
     * Sets the value of surname.
     * @param mixed $surname the surname
     * @return void
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
 
    /**
     * Gets the value of code.
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }
 
    /**
     * Sets the value of code.
     * @param mixed $code the code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
 
    /**
     * Gets the value of country.
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }
 
    /**
     * Sets the value of country.
     * @param mixed $country the country
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
 
    /**
     * Gets the value of signingCertificate.
     * @return mixed
     */
    public function getSigningCertificate()
    {
        return $this->signingCertificate;
    }
 
    /**
     * Sets the value of signingCertificate.
     * @param mixed $signingCertificate the signing certificate
     * @return void
     */
    public function setSigningCertificate($signingCertificate)
    {
        $this->signingCertificate = $signingCertificate;
    }
 
    /**
     * Gets the value of authenticationCertificate.
     * @return mixed
     */
    public function getAuthenticationCertificate()
    {
        return $this->authenticationCertificate;
    }
 
    /**
     * Sets the value of authenticationCertificate.
     * @param mixed $authenticationCertificate the authentication certificate
     * @return void
     */
    public function setAuthenticationCertificate($authenticationCertificate)
    {
        $this->authenticationCertificate = $authenticationCertificate;
    }
}
