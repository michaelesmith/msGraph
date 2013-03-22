<?php

namespace MS\Graph\Test;

use MS\Graph\Graph;
use MS\Graph\Node\Node;

/**
 * @author msmith
 */
class GraphTest extends TestCase
{
    public function testConstruct()
    {
        $n1 = new Node();
        $g = new Graph($n1);

        $this->assertSame($g, $n1->getGraph());
        $this->assertSame($n1, $g->getRoot());
    }

    public function testAddNode()
    {
        $n1 = new Node();
        $g = new Graph();
        $g->addNode($n1);

        $this->assertSame($g, $n1->getGraph());
    }

    public function testFilter()
    {
        $n1 = new Node();
        $g = new Graph($n1);

        $n2 = new Node();
        $n1->addChild($n2);

        $n3 = new Node();
        $n1->addChild($n3);

        $n4 = new Node();
        $n2->addChild($n4);

        $filtered = $g->filter(function($node) use ($n1, $n4){
            return $node === $n1 || $node === $n4;
        });

        $this->assertContains($n1, $filtered);
        $this->assertContains($n4, $filtered);
        $this->assertNotContains($n2, $filtered);
        $this->assertNotContains($n3, $filtered);
    }

    public function testWalk()
    {
        $n1 = new Node();
        $g = new Graph($n1);

        $n2 = new Node();
        $n1->addChild($n2);

        $n3 = new Node();
        $n1->addChild($n3);

        $n4 = new Node();
        $n2->addChild($n4);

        $walked = array();

        $g->walk(function($node) use (&$walked){
            $walked[] = $node;
        });

        $this->assertContains($n1, $walked);
        $this->assertContains($n2, $walked);
        $this->assertContains($n3, $walked);
        $this->assertContains($n4, $walked);
    }

}
