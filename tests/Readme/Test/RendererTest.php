<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 05.11.18
 * Time: 17:27
 */

namespace Readme\Test;

use Readme\Exceptions\NodeExistsException;
use Readme\Nodes\IncludeText;
use Readme\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    public function testAddNode()
    {
        $this->expectException(\TypeError::class);
        $renderer = new Renderer();
        $renderer->addNode(new \StdClass);
    }

    public function testAddExistsNode()
    {
        $this->expectException(NodeExistsException::class);
        $renderer = new Renderer();
        $renderer->addNode(new IncludeText());
    }

    public function testRender()
    {
        $file = getcwd() . '/tests/Readme/Test/templates/text/readme.md';
        $exampleFile = getcwd() . '/tests/Readme/Test/templates/text/readme.md.result';

        $renderer = new Renderer();
        $this->assertStringEqualsFile($exampleFile, $renderer->render($file));
    }

}
