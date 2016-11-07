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
 * Adds a list of ID’s to a segment
 */
class AddToSegmentResponse extends Response
{
    /**
     * @var integer response code
     */
    protected $AddToSegmentResult;

    /**
     *
     */
    public function __construct()
    {
        $this->AddToSegmentResult = Response::ERROR_QUERY;
    }

    /**
     * Possible errors returned :
     *
     * - Response::ERROR_FAILED
     * - Response::ERROR_LIST
     * - Response::ERROR_QUERY
     * - Response::ERROR_SEGMENT_NOT_FOUND
     *
     * @return integer response code
     */
    public function getCode()
    {
        return $this->AddToSegmentResult;
    }
}
