<?php
namespace Isign\Sign;

use Isign\QueryInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document sign status for mobile ID.
 */
class Sc implements QueryInterface
{
    /** @var string Session token received from /sc/prepare call */
    private $token;

    /** @var  string Signature value */
    private $signatureValue;

    /**
     * @param $token string Session token received from /sc/prepare call
     * @param $signatureValue string Signature value
     */
    public function __construct($token, $signatureValue)
    {
        $this->token = $token;
        $this->signatureValue = $signatureValue;
    }

    /**
     * Get fields
     * @return array
     */
    public function getFields()
    {
        return [
            'token' => $this->token,
            'signature_value' => $this->signatureValue,
        ];
    }

    /**
     * Validation constraints for request data validation
     * @return Assert\Collection
     */
    public function getValidationConstraints()
    {
        return new Assert\Collection([
            'token' => new Assert\Required(
                [new Assert\NotBlank()]
            ),
            'signature_value' => new Assert\Required(
                [new Assert\NotBlank()]
            )
        ]);
    }

    /**
     * Result object for this query result
     * @return MobileStatusResult
     */
    public function createResult()
    {
        return new ScResult();
    }

    /**
     * API action name, part of full url
     * @return string
     */
    public function getAction()
    {
        return 'sc/sign';
    }

    /**
     * HTTP method to use
     * @return string
     */
    public function getMethod()
    {
        return QueryInterface::POST;
    }
}
