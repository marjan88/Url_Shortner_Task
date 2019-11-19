<?php

namespace App\Exceptions;

use Throwable;

class LinkNotFoundException extends \Exception
{
    public function __construct(string $message = "Link not found!", int $code = 404, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
