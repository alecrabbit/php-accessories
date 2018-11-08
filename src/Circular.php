<?php
/**
 * User: alec
 * Date: 01.11.18
 * Time: 16:10
 */
declare(strict_types=1);

namespace AlecRabbit;


/**
 * Class Circular
 */
class Circular
{
    /** @var array */
    protected $data;

    /**
     * Circular constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        reset($this->data);
    }

    public function __invoke()
    {
        return $this->getElement();
    }

    /**
     * @return mixed
     */
    public function getElement()
    {
        if (($result = current($this->data)) === false) {
            $result = reset($this->data);
        }
        next($this->data);

        return $result;
    }


}