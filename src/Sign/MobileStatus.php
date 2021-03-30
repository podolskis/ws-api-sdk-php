<?php
namespace Dokobit\Sign;

use Dokobit\QueryInterface;
use Dokobit\TokenizedQueryInterface;
use Dokobit\Login\AbstractStatus;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document sign status for mobile ID.
 */
class MobileStatus extends AbstractStatus
{
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
        return 'mobile/sign/status';
    }
}
