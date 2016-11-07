<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 * Provides information about the current status of the system.
 */
class GetSystemStatusResponse extends Response
{
    /**
     * @var string
     */
    protected $GetSystemStatusResult;

    /**
     *
     */
    public function __construct()
    {
        $this->GetSystemStatusResult = 'error (unknown)';
    }

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
