<?php

/**
 * @version 0.1
 *
 * @author msmith
 */

namespace MS\Graph\Node;

use MS\Graph\Node\Node;

class IdentifiedNode extends Node
{
    protected $id;

    public function __construct($id, Graph $graph = null)
    {
        $this->id = $id;
        parent::__construct($graph);
    }

    public function getId()
    {
        return $this->id;
    }

}
