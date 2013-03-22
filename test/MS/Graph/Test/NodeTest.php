<?php

namespace MS\Graph\Test;

use MS\Graph\Graph;
use MS\Graph\Node\Node;

/**
 * @author msmith
 */
class NodeTest extends TestCase
{
    public function testConstruct()
    {
        $g = new Graph();
        $n1 = new Node($g);

        $this->assertSame($g, $n1->getGraph());
    }

    public function testAddChild()
    {
        $g = new Graph();
        $n1 = new Node($g);

        $n2 = new Node();
        $n1->addChild($n2);

        $this->assertContains($n2, $n1->getChildren());
        $this->assertContains($n1, $n2->getParents());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testAddChildException()
    {
        $n1 = new Node();

        $n2 = new Node();
        $n1->addChild($n2);
    }

    public function testAddParent()
    {
        $g = new Graph();
        $n1 = new Node();

        $n2 = new Node($g);
        $n2->addParent($n1);

        $this->assertContains($n2, $n1->getChildren());
        $this->assertContains($n1, $n2->getParents());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testAddParentException()
    {
        $n1 = new Node();

        $n2 = new Node();
        $n2->addParent($n1);
    }

    public function testHasChild()
    {
        $g = new Graph();
        $n1 = new Node($g);

        $n2 = new Node();
        $n1->addChild($n2);

        $n3 = new Node();
        $n1->addChild($n3);

        $n4 = new Node();
        $n2->addChild($n4);

        $this->assertTrue($n1->hasChild($n2));
        $this->assertTrue($n1->hasChild($n3));
        $this->assertFalse($n1->hasChild($n4));
    }

    public function testHasParent()
    {
        $g = new Graph();
        $n1 = new Node($g);

        $n2 = new Node();
        $n1->addChild($n2);

        $n3 = new Node();
        $n1->addChild($n3);

        $n4 = new Node();
        $n2->addChild($n4);

        $this->assertTrue($n2->hasParent($n1));
        $this->assertTrue($n3->hasParent($n1));
        $this->assertFalse($n1->hasParent($n4));
    }

    public function testIsLeaf()
    {
        $n1 = new Node();

        $this->assertTrue($n1->isLeaf());

        $g = new Graph();
        $n1 = new Node($g);

        $n2 = new Node();
        $n1->addChild($n2);

        $this->assertTrue($n2->isLeaf());
        $this->assertFalse($n1->isLeaf());
    }


    public function testIsRoot()
    {
        $n1 = new Node();

        $this->assertTrue($n1->isRoot());

        $g = new Graph();
        $n1 = new Node($g);

        $n2 = new Node();
        $n1->addChild($n2);

        $this->assertTrue($n1->isRoot());
        $this->assertFalse($n2->isRoot());
    }

}
