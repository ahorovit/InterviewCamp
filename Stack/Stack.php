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

        if (is_null($top))
        {
            return null;
        } else {
            $this->list->delete($top);
            return $top->getData();
        }
    }

    public function peek()
    {
        if ($this->list->empty())
        {
            return null;
        }

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