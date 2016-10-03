<?php

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 *
 */
class GetSystemStatusResponse extends Response
{
    protected $GetSystemStatusResult;

    public function getCode()
    {
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
     * @return string System status 
     */
    public function getVersion()
    {
        list(, $version) = sscanf($this->GetSystemStatusResult, '%s (%s');
        return trim($version, ')');
    }
}
