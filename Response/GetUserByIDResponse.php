<?php

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 *
 */
class GetUserByIDResponse extends Response
{
    /**
     *
     */
    protected $GetUserByIDResult;

    /**
     *
     */
    protected $ResultSet;

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->GetUserByIDResult;
    }

    /**
     *
     */
    public function getProperties()
    {
        return $this->ResultSet;
    }
}
