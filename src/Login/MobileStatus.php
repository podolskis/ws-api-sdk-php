<?php
namespace Isign\Login;

use Isign\QueryInterface;
use Isign\TokenizedQueryInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Login status for mobile ID.
 */
class MobileStatus implements TokenizedQueryInterface
{
    /** @var string unique resource identifier, received from mobile login request */
    private $token;

    /**
     * @param string $token unique resource identifier, received from mobile login request
     * @return self
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get token
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get fields
     * @return array
     */
    public function getFields()
    {
        return [
            'token' => $this->token,
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
            )
        ]);
    }

    /**
     * Result object for this query result
     * @return MobileStatusResult
     */
    public function createResult()
    {
        return new MobileStatusResult();
    }

    /**
     * API action name, part of full url
     * @return string
     */
    public function getAction()
    {
        return 'mobile/login/status';
    }

    /**
     * HTTP method to use
     * @return string
     */
    public function getMethod()
    {
        return QueryInterface::GET;
    }
}
