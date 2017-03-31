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
class TriggerCampaignForUserAndActionListItemResponse extends Response
{
    /**
     * @var int
     */
    protected $TriggerCampaignForUserAndActionListItem;

    /**
     *
     */
    public function __construct()
    {
        $this->TriggerCampaignForUserAndActionListItem = Response::ERROR_NORESULT;
        $this->result = '';
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return $this->TriggerCampaignForUserAndActionListItem;
    }
}
