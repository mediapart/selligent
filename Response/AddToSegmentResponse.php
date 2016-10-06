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
 * Adds a list of ID’s to a segment
 */
class AddToSegmentResponse extends Response
{
    /**
     * @var int
     */
    protected $AddToSegmentResult;

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->AddToSegmentResult;
    }
}
