<?php

namespace MS\Graph\Test;

use MS\Graph\Node\IdentifiedNode;

/**
 * @author msmith
 */
class IdentifiedNodeTest extends TestCase
{
    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testConstructException()
    {
        $n = new IdentifiedNode();
    }

    public function testGetId()
    {
        $n = new IdentifiedNode('1');

        $this->assertEquals('1', $n->getId());
    }

}
