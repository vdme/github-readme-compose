<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 01.11.18
 * Time: 22:34
 */

namespace Readme\Nodes;


use Readme\Exceptions\FileNotExistsException;

class IncludeText extends Node
{
    public function render($dir, $text): string
    {

        $text = preg_replace_callback("/\{text\:(.+)\}/", function ($matches) use ($dir) {

            $file = $dir . DIRECTORY_SEPARATOR . trim($matches[1], '" ');

            if (file_exists($file)) {
                return $this->renderer->render($file);
            } else {
                throw new FileNotExistsException($file);
            }
        }, $text);

        return $text;
    }
}