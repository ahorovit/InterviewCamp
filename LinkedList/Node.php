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
        $this->prev = $prev;
        return $this;
    }

    public function setData($data) : Node
    {
        $this->data = $data;
        return $this;
    }

    public function setNext(?Node $next): Node
    {
        $this->next = $next;

        if (!is_null($next)) {
            $next->setPrev($this);
        }

        return $this;
    }
}