<?php

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 *
 */
class GetSystemStatusResponse extends Response
{
    /**
     * @var string
     */
    protected $GetSystemStatusResult;

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        /* This is supposed to always returns something. 
           So it's always successful*/
        return Response::SUCCESSFUL;
    }

    /**
     *
     * @return string System status 
     */
    public function getStatus()
    {
        list($status,) = sscanf($this->GetSystemStatusResult, '%s (%s');
        return $status;
    }

    /**
     *
     * @return string Provider API version 
     */
    public function getVersion()
    {
        list(, $version) = sscanf($this->GetSystemStatusResult, '%s (%s');
        return trim($version, ')');
    }
}
