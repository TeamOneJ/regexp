<?php

namespace DanDoesCode\RegExp;

class Match {

    private $match;

    private $offset;

    private $parent;
    
    public function __construct($parent, $match, $offset = null)
    {
        $this->parent = $parent;
        $this->match = $match;
        $this->offset = $offset;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getMatch()
    {
        return $match;
    }

    public function getOffset()
    {
        return $offset;
    }

    public function __toString()
    {
        return $this->getMatch();
    }
}