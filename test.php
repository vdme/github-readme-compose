<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 05.11.18
 * Time: 19:58
 */

require "vendor/autoload.php";

$file = getcwd().'/tests/Readme/Test/templates/text/readme.md';

$renderer = new \Readme\Renderer();
echo $renderer->render($file);