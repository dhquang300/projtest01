<?php
namespace App\Exceptions;

use Exceptions;

class ValidationException extends Exception
{
    public function __construct($message){
        parent::_construct($message);
    }
}