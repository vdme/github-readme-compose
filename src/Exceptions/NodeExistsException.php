<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 05.11.18
 * Time: 17:31
 */

namespace Readme\Exceptions;


use Throwable;

class NodeExistsException extends Exception
{

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $rule = $message;
        $message = sprintf('The rule %s already exists in Renderer', $rule);
        parent::__construct($message, $code, $previous);
    }
}