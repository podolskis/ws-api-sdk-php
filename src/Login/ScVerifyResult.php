<?php


namespace Dokobit\Login;

use Dokobit\StatusResultInterface;

class ScVerifyResult implements StatusResultInterface
{
    /** @var string */
    private $status;

    /** @var string */
    private $name;

    /** @var string */
    private $surname;

    /** @var string */
    private $code;

    /** @var string email not always available */
    private $email;

    /** @var string */
    private $country;

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
            'email',
            'country',
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
     * Gets the value of email.
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
 
    /**
     * Sets the value of email.
     * @param mixed $email the email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
}
