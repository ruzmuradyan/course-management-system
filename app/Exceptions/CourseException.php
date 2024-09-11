<?php

namespace App\Exceptions;

use Exception;

class CourseException extends Exception
{
    public function __construct($message = "An error occured", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function render($request){
        return response()->json([
            'error' => $this->getMessage(),
        ],$this->getCode()  ?: Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
