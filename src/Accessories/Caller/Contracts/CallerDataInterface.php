<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller\Contracts;

interface CallerDataInterface extends CallerConstants
{
    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @return string
     */
    public function getFunction(): string;

    /**
     * @return null|int
     */
    public function getLine(): ?int;

    /**
     * @return null|string
     */
    public function getFile(): ?string;

    /**
     * @return null|string
     */
    public function getClass(): ?string;

    /**
     * @return null|object
     */
    public function getObject(): ?object;

    /**
     * @return null|string
     */
    public function getType(): ?string;

    /**
     * @return null|array
     */
    public function getArgs(): ?array;
}
