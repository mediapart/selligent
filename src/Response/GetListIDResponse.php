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
 * Get the id of a list by using its name
 */
class GetListIDResponse extends Response
{
    /**
     * @var int Id of the found list
     */
    protected $GetListIDResult;

    /**
     * @var int Id of the found list
     */
    protected $id;

    /**
     *
     */
    public function __construct()
    {
        $this->GetListIDResult = 0;
        $this->id = null;
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->GetListIDResult;
    }

    /**
     * @return int Id of the found list
     */
    public function getId()
    {
        return $this->id;
    }
}
