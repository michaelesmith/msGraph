<?php
/**
 * @version 0.1
 *
 * @author msmith
 */

namespace MS\Graph;

use MS\Graph\Graph;
use MS\Graph\Node\Node;
use MS\Graph\Node\IdentifiedNode;

class IdentifiedGraph extends Graph
{
    public function addNode(Node $node)
    {
        if(!$node instanceof IdentifiedNode){
            throw new \InvalidArgumentException('Nodes used with IdentifiedGraph must be instance of IdentifiedNode');
        }
        if(!in_array($node, $this->nodes, true) && $this->findById($node->getId())){ //do not test if already in graph
            throw new \InvalidArgumentException(sprintf('Nodes used with IdentifiedGraph must have a unique id "%s" given', $node->getId()));
        }
        parent::addNode($node);
    }

    public function findById($id)
    {
        $filtered =  $this->filter(function(IdentifiedNode $node) use ($id) {
            return $node->getId() == $id;
        });

        if(count($filtered)){

            return current($filtered);
        }
    }

}
