<?php


namespace Isign\Login;

use Isign\QueryInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Sc implements QueryInterface
{
    /** @var string base64_encode(certificate) */
    private $certificate;

    /**
     * @param $certificate string base64_encode(certificate)
     */
    public function __construct($certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * API action name, part of full API request url
     * @return string
     */
    public function getAction()
    {
        return 'sc/login';
    }

    /**
     * Field and values association used in query
     * @return array
     */
    public function getFields()
    {
        return [
            'certificate'   => $this->certificate
        ];
    }

    /**
     * Result object for this query result
     * @return MobileResult
     */
    public function createResult()
    {
        return new ScResult();
    }

    /**
     * Validation constraints for fields
     * @return array
     */
    public function getValidationConstraints()
    {
        return new Assert\Collection([
            'certificate' => new Assert\Required([
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
}
