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
class TriggerCampaignForUserAndActionListItemWithResultResponse extends Response
{
    /**
     * @var int
     */
    protected $TriggerCampaignForUserAndActionListItemWithResultResponse;

    /**
     * @var string
     */
    protected $result;

    /**
     *
     */
    public function __construct()
    {
        $this->TriggerCampaignForUserAndActionListItemWithResultResponse = Response::ERROR_NORESULT;
        $this->result = '';
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->TriggerCampaignForUserAndActionListItemWithResultResponse;
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
