<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Tests\Integrated;

use PHPUnit\Framework\TestCase;

class IntegrationTestCase extends TestCase
{
    protected function requireEnv($requiredEnv)
    {
        $defined = true;
        foreach ($requiredEnv as $env) {
            if (empty(getenv($env))) {
                $defined = false;
                break;
            }
        }

        if (!$defined) {
            $this->markTestSkipped(
              "Skipping tests because $env value is missing."
            );
        }
    }
}
