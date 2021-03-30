<?php
namespace Dokobit\Login;

use Dokobit\QueryInterface;
use Dokobit\Validator\Constraints\Code;
use Dokobit\Validator\Constraints\Phone;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Login using mobile ID.
 */
class Mobile implements QueryInterface
{
    /** @var string user phone number */
    private $phone;

    /** @var string user personal code */
    private $code;

    /** @var string language used for login message */
    private $language;

    /** @var string custom login message to be displayed in mobile phone */
    private $message;

    /**
     * @param string $phone user phone number
     * @param string $code user personal code
     * @param string $language language used for login message
     * @param string $message custom login message to be displayed in mobile phone
     */
    public function __construct(
        $phone,
        $code,
        $language = null,
        $message = null
    ) {
        $this->phone = $phone;
        $this->code = $code;
        $this->language = $language;
        $this->message = $message;
    }

    /**
     * Field and values association used in query
     * @return array
     */
    public function getFields()
    {
        $return = [
            'phone' => $this->phone,
            'code' => $this->code,
        ];

        if ($this->language !== null) {
            $return['language'] = $this->language;
        }

        if ($this->message !== null) {
            $return['message'] = $this->message;
        }

        return $return;
    }

    /**
     * Validation constraints for request data validation
     * @return Assert\Collection
     */
    public function getValidationConstraints()
    {
        return new Assert\Collection([
            'phone' => new Assert\Required([
                new Assert\NotBlank(),
                new Phone(),
            ]),
            'code' => new Assert\Required([
                new Assert\NotBlank(),
                new Code()
            ]),
            'language' => new Assert\Optional(),
            'message' => new Assert\Optional(),
        ]);
    }

    /**
     * Result object for this query result
     * @return MobileResult
     */
    public function createResult()
    {
        return new MobileResult();
    }

    /**
     * API action name, part of full API request url
     * @return string
     */
    public function getAction()
    {
        return 'mobile/login';
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
