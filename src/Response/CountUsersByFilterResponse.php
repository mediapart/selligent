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
class CountUsersByFilterResponse extends Response
{
    /**
     * @var int
     */
    protected $CountUsersByFilterResult;

    /**
     * @var int
     */
    protected $userCount;

    /**
     *
     */
    public function __construct()
    {
        $this->CountUsersByFilterResult = Response::ERROR_FAILED;
        $this->userCount = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->CountUsersByFilterResult;
    }

    /**
     * @return int
     */
    public function getUserCount()
    {
        return $this->userCount;
    }
}
