<?php

/**
 * @version 0.1
 *
 * @author msmith
 */

namespace MS\Graph;

use MS\Graph\Node\Node;

class Graph
{
    protected $root;
    protected $nodes = array();

    public function __construct(Node $node = null)
    {
        if($node){
            $this->setRoot($node);
        }
    }

    public function setRoot(Node $node)
    {
        $this->addNode($node);
        $this->root = $node;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function addNode(Node $node)
    {
        if(!in_array($node, $this->nodes, true)){
            $this->nodes[] = $node;
        }
        $node->setGraph($this);
    }

    public function filter(\Closure $func)
    {
        return array_filter($this->nodes, $func);
    }

    public function walk(\Closure $func)
    {
        return array_walk($this->nodes, $func);
    }
}
