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
class GetUsersByConstraintResponse extends Response
{
    /**
     * @var integer
     */
    protected $GetUsersByConstraintResult;

    /**
     * @var s\tdClass
     */
    protected $ResultIDs;

    /**
     *
     */
    public function __construct()
    {
        $this->GetUsersByConstraintResult = Response::ERROR_NORESULT;
        $this->ResultIDs = new \stdClass;
        $this->ResultIDs->int = [];
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->GetUsersByConstraintResult;
    }

    /**
     * @return integer[]
     */
    public function getIds()
    {
        return $this->ResultIDs->int;
    }
}
