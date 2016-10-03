<?php

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 *
 */
class GetUsersByConstraintResponse extends Response
{
    /**
     *
     */
    protected $GetUsersByConstraintResult;

    /**
     *
     */
    protected $ResultIDs;

    /**
     *
     */
    public function getCode()
    {
        return $this->GetUsersByConstraintResult;
    }

    /**
     *
     */
    public function getIds()
    {
        return $this->ResultIDs->int;
    }
}
