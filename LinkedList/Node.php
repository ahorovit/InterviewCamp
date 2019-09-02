<?php

namespace InterviewCamp\LinkedList;

class Node
{
    /** @var mixed */
    protected $data;

    /** @var Node */
    protected $next;

    /** @var Node */
    protected $prev; // Doubly-linked list

    public function __construct($data, $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function getPrev()
    {
        return $this->prev;
    }

    public function setPrev(?Node $prev)
    {
        if (!is_null($prev)) {
            $this->prev = $prev;
            $prev->setNext($this);
        }

        return $this;
    }

    public function setData($data) : Node
    {
        $this->data = $data;
        return $this;
    }

    public function setNext(?Node $next): Node
    {
        if (!is_null($next))
        {
            $this->next = $next;
            $next->setPrev($this);
        }
        return $this;
    }
}