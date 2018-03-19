<?php
namespace Isign\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Validator found violations while validating query field values
 */
class QueryValidator extends \InvalidArgumentException
{
    /** @var ConstraintViolationList */
    private $violations;

    /**
     * @param string $message
     * @param ConstraintViolationListInterface $violations
     */
    public function __construct($message, ConstraintViolationList $violations)
    {
        parent::__construct($message.': '.(string)$violations);

        $this->violations = $violations;
    }

    /**
     * Get validation violations
     * @return ConstraintViolationListInterface
     */
    public function getViolations()
    {
        return $this->violations;
    }
}
