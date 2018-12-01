<?php
/**
 * User: alec
 * Date: 30.11.18
 * Time: 18:06
 */

namespace AlecRabbit\Traits;


trait GettableName
{
    /** @var string */
    protected $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return string
     */
    public function default(?string $name = null): string
    {
        return $name ?? 'default_name';
    }

}