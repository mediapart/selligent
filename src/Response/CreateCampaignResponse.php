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
class CreateCampaignResponse extends Response
{
    /**
     *
     */
    const WARNING = 20001;

    /**
     *
     */
    protected $CreateCampaignResult;

    /**
     *
     */
    protected $Xml;

    /**
     *
     */
    public function __construct()
    {
        $this->CreateCampaignResult = Response::ERROR_NORESULT;
        $this->Xml = null;
    }

    /**
     *
     */
    public function getCode()
    {
        if (self::SUCCESSFUL == $this->CreateCampaignResult && !empty($this->ErrorStr)) {
            $code = self::WARNING;
        } else {
            $code = $this->CreateCampaignResult;
        }

        return $code;
    }

    /**
     */
    public function getXml()
    {
        return $this->Xml;
    }
}
