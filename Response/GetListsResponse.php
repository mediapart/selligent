<?php

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 *
 */
class GetListsResponse extends Response
{
    /**
     *
     */
    protected $GetListsResult;

    /**
     *
     */
    protected $lists;

    /**
     *
     */
    public function getCode()
    {
        return $this->GetListsResult;
    }

    /**
     *
     */
    public function getLists()
    {
        return $this->lists;
    }
}
