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
use Mediapart\Selligent\ArrayOfListInfo;

/**
 * Retrieve a series of lists
 */
class GetListsResponse extends Response
{
    /**
     * @var int
     */
    protected $GetListsResult;

    /**
     * @var ArrayOfListInfo
     */
    protected $lists;

    /**
     *
     */
    public function __construct()
    {
        $this->GetListsResult = Response::ERROR_NORESULT;
        $this->lists = new ArrayOfListInfo();
    }

    /**
     * @return int Result of the function
     */
    public function getCode()
    {
        return $this->GetListsResult;
    }

    /**
     * @return ArrayOfListInfo List of found lists
     */
    public function getLists()
    {
        return $this->lists;
    }
}
