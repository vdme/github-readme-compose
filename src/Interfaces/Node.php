<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 01.11.18
 * Time: 22:29
 */

namespace Readme\Interfaces;


interface Node
{
    public function getRule(): string;

    public function setRenderer(Renderer $renderer): void;

    public function render($dir, $text);
}