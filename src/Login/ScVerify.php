<?php


namespace Isign\Login;

use Isign\QueryInterface;
use Isign\ResultInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ScVerify implements QueryInterface
{
    /** @var string Uses token received from /sc/login call  */
    private $token;

    /** @var string User signed value */
    private $signatureValue;

    public function __construct($token, $signatureValue)
    {
        $this->token = $token;
        $this->signatureValue = $signatureValue;
    }

    /**
     * API action name, part of full API request url
     * @return string
     */
    public function getAction()
    {
        return 'sc/login/verify';
    }

    /**
     * Field and values association used in query
     * @return array
     */
    public function getFields()
    {
        return [
            'token' => $this->token,
            'signature_value' => $this->signatureValue
        ];
    }

    /**
     * Result object for this query result
     * @return ResultInterface
     */
    public function createResult()
    {
        return new ScVerifyResult();
    }

    /**
     * Validation constraints for fields
     * @return array
     */
    public function getValidationConstraints()
    {
        return new Assert\Collection([
            'token' => new Assert\Required([
                new Assert\NotBlank(),
            ]),
            'signature_value' => new Assert\Required([
                new Assert\NotBlank(),
            ])
        ]);
    }

    /**
     * HTTP method to use
     * @return string
     */
    public function getMethod()
    {
        return QueryInterface::POST;
    }

    /**
     * Get unique resource identifier, received from mobile login request
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getSignatureValue()
    {
        return $this->signatureValue;
    }
}
