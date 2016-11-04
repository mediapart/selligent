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
class TriggerCampaignResponse extends Response
{
    /**
     * @var int
     */
    protected $TriggerCampaignResult;

    /**
     *
     */
    public function __construct()
    {
        $this->TriggerCampaignResult = Response::ERROR_FAILED;
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->TriggerCampaignResult;
    }
}
