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
