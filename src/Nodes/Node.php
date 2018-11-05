<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 01.11.18
 * Time: 22:36
 */

declare(strict_types=1);

namespace Readme\Nodes;

abstract class Node implements \Readme\Interfaces\Node
{
    /**
     * @var \Readme\Interfaces\Renderer
     */
    protected $renderer;

    public function setRenderer(\Readme\Interfaces\Renderer $renderer): void
    {
        $this->renderer = $renderer;
    }

    public function getRule(): string
    {
        return static::class;
    }

}