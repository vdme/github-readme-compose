<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 01.11.18
 * Time: 22:30
 */

namespace Readme\Interfaces;


interface Renderer
{

    public function render(string $text = null) : string;

    public function addNode(Node $file);

}