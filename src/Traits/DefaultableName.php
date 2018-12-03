<?php
/**
 * User: alec
 * Date: 01.12.18
 * Time: 22:17
 */

namespace AlecRabbit\Traits;

use AlecRabbit\Constants;

trait DefaultableName
{
    /**
     * @param string|null $name
     * @return string
     */
    public function default(?string $name = null): string
    {
        return $name ?? Constants::DEFAULT_NAME;
    }
}
