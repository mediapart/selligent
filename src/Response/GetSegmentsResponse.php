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
use Mediapart\Selligent\ArrayOfSegmentsInfo;

/**
 * Gets the segments for a specific list
 */
class GetSegmentsResponse extends Response
{
    /**
     * @var int The result of the function
     */
    protected $GetSegmentsResult;

    /**
     * @var ArrayOfSegmentsInfo List of found segments
     */
    protected $segments;

    public function __construct()
    {
        $this->GetSegmentsResult = Response::ERROR_NORESULT;
        $this->segments = [];
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->GetSegmentsResult;
    }

    /**
     * @return ArrayOfSegmentsInfo List of found segments
     */
    public function getSegments()
    {
        return $this->segments;
    }
}
