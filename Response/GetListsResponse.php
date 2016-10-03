<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * (c) mediapart <https://github.com/mediapart/selligent>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Response;

use Mediapart\Selligent\Response;

/**
 *
 */
class GetListsResponse extends Response
{
    /**
     *
     */
    protected $GetListsResult;

    /**
     *
     */
    protected $lists;

    /**
     *
     */
    public function getCode()
    {
        return $this->GetListsResult;
    }

    /**
     *
     */
    public function getLists()
    {
        return $this->lists;
    }
}
