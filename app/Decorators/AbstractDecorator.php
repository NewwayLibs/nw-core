<?php namespace App\Decorators;

/**
 * Class AbstractDecorator
 * @package App\Decorators
 */
abstract class AbstractDecorator {

    protected $object;

    public function __construct($object){


        $this->object = $object;
    }

    public function __toString()
    {

        return $this->getDecorated();
    }

    abstract function getDecorated();


}