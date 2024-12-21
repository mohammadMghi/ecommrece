<?php

namespace App\Response;

class ResponseHandler
{
    private string $message;
    private int $status_code; 
    public function __construct($message , $status_code = 500)
    {
        $this->status_code = $status_code;
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getStatusCode()
    {
        return $this->status_code;
    }
}