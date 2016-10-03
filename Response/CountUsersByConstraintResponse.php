<?php

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 *
 */
class CountUsersByConstraintResponse extends Response
{
    /**
     * @var int
     */
    protected $CountUsersByConstraintResult;

    /**
     * @var int
     */
    protected $userCount;

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->CountUsersByConstraintResult;
    }

    /**
     * @return int
     */
    public function getUserCount()
    {
        return $this->userCount;
    }
}
