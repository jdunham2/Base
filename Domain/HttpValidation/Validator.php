<?php

namespace Domain\HttpValidation;


abstract class Validator implements ValidatorInterface
{

    protected $rule_params;
    protected $invalidMessage = "Validator message not set";

    public function __construct($rule_params)
    {
        $this->rule_params = $rule_params;
    }

    abstract function isValid($input);

    function getInvalidMessage()
    {
        return $this->invalidMessage;
    }

    public function setInvalidMessage($invalidMessage)
    {
        $this->invalidMessage = $invalidMessage;
    }
}