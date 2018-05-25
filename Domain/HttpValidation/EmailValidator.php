<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/24/18
 * Time: 3:19 AM
 */

namespace Domain\HttpValidation;


class EmailValidator extends Validator
{
    protected $invalidMessage = "Not a valid eMail";

    function isValid($input)
    {
        return filter_var($input, FILTER_VALIDATE_EMAIL) ? true : false;
    }
}