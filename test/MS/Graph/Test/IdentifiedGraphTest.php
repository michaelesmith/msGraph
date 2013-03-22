<?php

namespace MS\Graph\Test;

use MS\Graph\IdentifiedGraph;
use MS\Graph\Node\IdentifiedNode;
use MS\Graph\Node\Node;

/**
 * @author msmith
 */
class IdentifiedGraphTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddNodeExceptionType()
    {
        $g = new IdentifiedGraph();
        $n1 = new Node();
        $g->addNode($n1);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddNodeExceptionUniqueId()
    {
        $g = new IdentifiedGraph();
        $n1 = new IdentifiedNode('1');
        $g->addNode($n1);
        $n2 = new IdentifiedNode('1');
        $g->addNode($n2);
    }

    public function testFindById()
    {
        $g = new IdentifiedGraph();

        $n1 = new IdentifiedNode('1');
        $g->setRoot($n1);

        $n2 = new IdentifiedNode('2');
        $n1->addChild($n2);

        $n3 = new IdentifiedNode('3');
        $n2->addChild($n3);

        $this->assertSame($n3, $g->findById('3'));
        $this->assertNull($g->findById('7'));
    }

}
