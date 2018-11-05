<?php
/**
 * Created by PhpStorm.
 * User: vdme
 * Date: 01.11.18
 * Time: 20:55
 */

declare(strict_types=1);

namespace Readme;

use Readme\Exceptions\FileNotExistsException;
use Readme\Exceptions\NodeExistsException;
use Readme\Interfaces\Node;
use Readme\Nodes\IncludeText;
use Readme\Nodes\JsonCode;

class Renderer implements \Readme\Interfaces\Renderer
{
    private $nodes = [];
    private $dir;
    private $text;

    /**
     * Renderer constructor.
     * @param $file
     * @throws NodeExistsException
     * @throws FileNotExistsException
     */
    public function __construct()
    {
        $this->addNode(new IncludeText);
        $this->addNode(new JsonCode);
    }

    public function render(string $file = null): string
    {
        if (file_exists($file)) {
            $dir = dirname($file);
            $text = file_get_contents($file);
        } else {
            throw new FileNotExistsException($file);
        }

        foreach ($this->nodes as $node) {
            $text = $node->render($dir, $text);
        }

        return $text;
    }

    /**
     * @param Node $node
     * @throws NodeExistsException
     */
    public function addNode(Node $node)
    {
        $rule = $node->getRule();

        if (!array_key_exists($rule, $this->nodes)) {
            $this->nodes[$rule] = $node;
            $node->setRenderer($this);
        } else {
            throw new NodeExistsException($rule);
        }
    }
}