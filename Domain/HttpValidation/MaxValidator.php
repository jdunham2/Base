<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/23/18
 * Time: 8:03 PM
 */

namespace Domain\HttpValidation;


class MaxValidator extends Validator
{
    public function isValid($input)
    {
        return strlen($input) <= $this->rule_params;
    }

    public function getInvalidMessage()
    {
        return "must be shorter than {$this->rule_params} characters long";
    }

}