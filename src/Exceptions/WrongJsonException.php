<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 05.11.18
 * Time: 20:53
 */

namespace Readme\Exceptions;


class WrongJsonException extends Exception
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        $file = $message;
        $message = sprintf('Wrong json format in the file %s', $file);
        parent::__construct($message, $code, $previous);
    }

}