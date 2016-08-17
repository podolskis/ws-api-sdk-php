<?php
namespace Isign\Validator\Constraints;

use Symfony\Component\Validator\Constraints\Regex;

/**
 * Class Phone
 * @package IsignApiBundle
 */
class Phone extends Regex
{
    const REGEX_FAILED_ERROR = 'de1e3db3-5ed4-4941-aae4-59f3667cc3a3';
    
    /**
     * Base validation pattern which includes + char only,
     * all other parts are built on the fly
     */
    const VALIDATION_PATTERN = '/^\+(%s)$/';

    /**
     * @var string
     */
    public $message = 'Phone number format is not valid';

    /**
     * @param mixed $options
     * @return self
     */
    public function __construct($options = null)
    {
        $options['pattern'] = sprintf(
            self::VALIDATION_PATTERN,
            $this->buildPattern($this->getCountryPatterns())
        );
        parent::__construct($options);
    }

    /**
     * Build one regexp pattern from given list of patterns
     * @param array $patterns
     * @return string built regexp
     */
    private function buildPattern(array $patterns)
    {
        $parts = [];
        foreach ($patterns as $pattern) {
            $parts[] = sprintf('(%s)', $pattern);
        }

        return implode('|', $parts);
    }

    /**
     * Regexp patterns by country
     * IMPORTANT!
     * DO NOT FORGET TO UPDATE REGULAR EXPRESSION VALIDATOR IN JAVASCRIPT!
     * @return array
     */
    private function getCountryPatterns()
    {
        return [
            'lt' => '3706\d{7}',
            'ee' => '372\d{7,8}',
            'fi' => '358(4[0-9]{1}|467|50)\d{4,8}',
        ];
    }
}
