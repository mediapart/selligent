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
class RetrieveHashForUserResponse extends Response
{
    /**
     * @var int
     */
    protected $RetrieveHashForUserResult;

    /**
     * @var string
     */
    protected $HashCode;

    /**
     *
     */
    public function __construct()
    {
        $this->RetrieveHashForUserResult = Response::ERROR_FAILED;
        $this->HashCode = null;
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->RetrieveHashForUserResult;
    }

    /**
     * @return string
     */
    public function getHashCode()
    {
        return $this->HashCode;
    }
}
