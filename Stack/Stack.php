<?php

namespace InterviewCamp\Stack;

use InterviewCamp\LinkedList\LinkedList;
use InterviewCamp\LinkedList\Node;

class Stack
{
    /** @var LinkedList */
    protected $list;

    public function push($value)
    {
        $this->list->append(new Node($value));
    }

    public function pop()
    {
        $top = $this->list->getTail();
        $this->list->delete($top);
        return $top->getData();
    }

    public function peek()
    {
        return $this->list->getTail()->getData();
    }

    public function empty() : bool
    {
        return $this->list->empty();
    }

    public function printValues()
    {
        $this->list->printValues();
    }
}