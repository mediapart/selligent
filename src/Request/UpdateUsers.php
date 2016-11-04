<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Request;

/**
 * Request to update users.
 *
 * @doc See doc/Reference.md#updateusers
 */
class UpdateUsers
{
    /**
     * Insert mode
     *
     * @var int 1
     */
    const INSERT = 0x01;

    /**
     * Update mode
     *
     * @var int 2
     */
    const UPDATE = 0x10;
}
