<?php

/**
 * @version 0.1
 *
 * @author msmith
 */

namespace MS\Graph\Node;

use MS\Graph\Graph;

class Node
{
    protected $children = array(), $parents = array();
    protected $graph;

    public function __construct(Graph $graph = null)
    {
        if($graph){
            $this->setGraph($graph);
        }
    }

    public function setGraph(Graph $graph)
    {
        $this->graph = $graph;
    }

    /**
     * @return Graph
     */
    public function getGraph()
    {
        return $this->graph;
    }

    public function addChild(Node $node)
    {
        if(!$this->getGraph()){
            throw new \RuntimeException('Can not add child to node without a graph object set');
        }

        $this->children[] = $node;
        $this->getGraph()->addNode($node);
        if(!$node->hasParent($this)){
            $node->addParent($this);
        }
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function hasChild(Node $node)
    {
        return in_array($node, $this->children, true);
    }

    public function isLeaf()
    {
        return count($this->children) == 0;
    }

    public function addParent(Node $node)
    {
        if(!$this->getGraph()){
            throw new \RuntimeException('Can not add parent to node without a graph object set');
        }

        $this->parents[] = $node;
        $this->getGraph()->addNode($node);
        if(!$node->hasChild($this)){
            $node->addChild($this);
        }
    }

    public function getParents()
    {
        return $this->parents;
    }

    public function hasParent(Node $node)
    {
        return in_array($node, $this->parents, true);
    }

    public function isRoot()
    {
        return count($this->parents) == 0;
    }

}
