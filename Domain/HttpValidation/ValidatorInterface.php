<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/23/18
 * Time: 8:06 PM
 */

namespace Domain\HttpValidation;


interface ValidatorInterface
{
    function isValid($input);

    function getInvalidMessage();

}