<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent;

/**
 *
 */
abstract class Response
{
    /**
     */
    const SUCCESSFUL = 0;

    /** 
     * Error during storage SELLIGENT object (list/mail/journey map). 
     * Occurs when IP is blocked for login, the database is down or login fails.
     */
    const ERROR_OBJECTSTORE = 10001;

    /**
     * Error during load list
     */
    const ERROR_LIST = 10002;

    /**
     * Error in internal query. 
     * The query fails for instance due to wrong parameters. 
     */
    const ERROR_QUERY = 10003;

    /**
     * Error in filter (constraint built from filter values).
     * Occurs when the filter parameter is empty
     */
    const ERROR_FILTER = 10004;

    /**
     * Query does not return results 
     */
    const ERROR_NORESULT = 10005;

    /**
     * The individual call has failed 
     */
    const ERROR_FAILED = 10006;

    /**
     * Insecure constraint. 
     * Occurs for instance when special characters are used (e.g. $)
     */
    const ERROR_UNSAFECONSTRAINT = 10008;

    /**
     * The given constraint cannot be parsed. 
     * Occurs when the method TriggerCampaignByXML is used and the XML cannot be parsed 
     */
    const ERROR_XML_UNPARSABLE = 10009;

    /**
     * Segment not found.
     * Occurs when the segment id given as parameter is not found on the platform
     */
    const ERROR_SEGMENT_NOT_FOUND = 10010;

    /**
     * The upsert method is invalid. 
     * Occurs when the mode parameter is set incorrectly for InternalUpdate Users 
     * – 1: insert, 2: update, 3: insertupdate 
     */
    const ERROR_INVALID_UPSERT_MODE = 10011;

    /**
     * The gate has been disabled
     */
    const ERROR_GATE_DISABLED = 10012;

    /**
     * One or more arguments are invalid. 
     * Occurs when one of the entry parameters is incorrect.
     */
    const ERROR_INVALID_ARGUMENT = 10013;

    /**
     * No rights to create entities
     */
    const ERROR_NO_CREATE_RIGHTS = 10014;

    /**
     * The given action code is invalid or not in line with Selligent specifications
     */
    const ERROR_INVALID_ACTIONCODE = 10015; 

    /**
     * The given column name is invalid. 
     * Occurs when the name of the column has been wrongly mentioned, 
     * e.g. the name of the column is misspelled in the information passed in the method InsertUsers
     */
    const ERROR_INVALID_COLUMNNAME = 10016;

    /**
     * @var string
     */
    protected $ErrorStr;

    /**
     * @return int
     */
    abstract public function getCode();

    /**
     * @return string
     */
    public function getError()
    {
        return $this->ErrorStr;
    }
}
