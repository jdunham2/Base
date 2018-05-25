<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/23/18
 * Time: 10:52 PM
 */

namespace Domain\HttpValidation;


class RequiredValidator extends Validator
{
    protected $invalidMessage = "is required";

    function isValid($input)
    {
        return !empty($input);
    }
}