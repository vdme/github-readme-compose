<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 05.11.18
 * Time: 17:56
 */

namespace Readme\Exceptions;

use Throwable;

class FileNotExistsException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $file = $message;
        $message = sprintf("file \"%s\" not exists", $file);
        parent::__construct($message, $code, $previous);
    }
}