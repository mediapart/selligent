<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Reponse;

use Mediapart\Selligent\Reponse;

/**
 *
 */
class TriggerCampaignByXmlWithResultResponse extends Response
{
    /**
     *
     */
    protected $TriggerCampaignByXmlWithResultResult;

    /**
     *
     */
    public function getCode()
    {
        return $this->TriggerCampaignByXmlWithResultResult;
    }
}
