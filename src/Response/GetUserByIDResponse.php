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
use Mediapart\Selligent\Properties;

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
     *
     */
    public function __construct()
    {
        $this->GetUserByIDResult = Response::ERROR_NORESULT;
        $this->ResultSet = new Properties();
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->GetUserByIDResult;
    }

    /**
     * @return Properties
     */
    public function getProperties()
    {
        return $this->ResultSet;
    }
}
