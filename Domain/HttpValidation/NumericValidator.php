<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/23/18
 * Time: 9:09 PM
 */

namespace Domain\HttpValidation;


class NumericValidator extends Validator
{

    function isValid($input)
    {
        return is_numeric($input);
    }

    function getInvalidMessage()
    {
        return "is not numeric";
    }
}