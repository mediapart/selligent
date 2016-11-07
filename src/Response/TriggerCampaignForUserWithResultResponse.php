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
 * Trigger the execution of the specified journey map for a specific contact.
 */
class TriggerCampaignForUserWithResultResponse extends Response
{
    /**
     * @var int
     */
    protected $TriggerCampaignForUserWithResultResult;

    /**
     * @var string
     */
    protected $result;

    /**
     *
     */
    public function __construct()
    {
        $this->TriggerCampaignForUserWithResultResult = Response::ERROR_NORESULT;
        $this->result = '';
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->TriggerCampaignForUserWithResultResult;
    }

    /**
     * Returns a html page if defined in the journey map, else the result is empty
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }
}
