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
     * @return string
     */
    public function defaultName(): string
    {
        return 'default_name';
    }

}