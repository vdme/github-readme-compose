<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 05.11.18
 * Time: 20:47
 */


namespace Readme\Nodes;

use Readme\Exceptions\FileNotExistsException;
use Readme\Exceptions\WrongJsonException;

class JsonCode extends Node
{

    public function render($dir, $text): string
    {
        $text = preg_replace_callback("/\{json\:(.+)\}/", function ($matches) use ($dir) {

            $file = $dir . DIRECTORY_SEPARATOR . trim($matches[1], '" ');

            if (file_exists($file)) {
                $res = $this->renderer->render($file);
                $res = json_decode(json_encode($res));
                if ("null" === $res) {
                    throw new WrongJsonException($file);
                }
                return $this->prettyPrint($res);
            } else {
                throw new FileNotExistsException($file);
            }
        }, $text);

        return $text;

    }

    private function prettyPrint($json)
    {
        $result = '';
        $level = 0;
        $in_quotes = false;
        $in_escape = false;
        $ends_line_level = NULL;
        $json_length = strlen($json);
        for ($i = 0; $i < $json_length; $i++) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if ($ends_line_level !== NULL) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if ($in_escape) {
                $in_escape = false;
            } else if ($char === '"') {
                $in_quotes = !$in_quotes;
            } else if (!$in_quotes) {
                switch ($char) {
                    case '}':
                    case ']':
                        $level--;
                        $ends_line_level = NULL;
                        $new_line_level = $level;
                        break;
                    case '{':
                    case '[':
                        $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;
                    case ':':
                        $post = " ";
                        break;
                    case " ":
                    case "  ":
                    case "\n":
                    case "\r":
                        $char = "";
                        $ends_line_level = $new_line_level;
                        $new_line_level = NULL;
                        break;
                }
            } else if ($char === '\\') {
                $in_escape = true;
            }
            if ($new_line_level !== NULL) {
                $result .= "\n" . str_repeat("  ", $new_line_level);
            }
            $result .= $char . $post;
        }
        return $result;
    }
}

