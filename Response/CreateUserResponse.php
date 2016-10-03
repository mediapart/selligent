<?php

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 *
 */
class CreateUserResponse extends Response
{
    /**
     * @var int
     */
    protected $CreateUserResult;

    /**
     * @var int
     */
    protected $ID;

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->CreateUserResult;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->ID;
    }
}
