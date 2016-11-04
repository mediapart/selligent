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
     *
     */
    public function __construct()
    {
        $this->ID = 0;
        $this->CreateUserResult = Response::ERROR_FAILED;
    }

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
