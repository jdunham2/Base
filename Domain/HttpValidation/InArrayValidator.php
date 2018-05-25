<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/23/18
 * Time: 9:19 PM
 */

namespace Domain\HttpValidation;


class InArrayValidator extends Validator
{

    function isValid($input)
    {
        return in_array(strtolower($input), explode(',', strtolower($this->rule_params)));
    }

    function getInvalidMessage()
    {
        return "must be in [{$this->rule_params}]";
    }
}