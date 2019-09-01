<?php

namespace InterviewCamp\LinkedList;

class Node
{
    /** @var mixed */
    protected $data;

    /** @var Node */
    protected $next;

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

    public function setData($data) : Node
    {
        $this->data = $data;
        return $this;
    }

    public function setNext(?Node $next): Node
    {
        $this->next = $next;
        return $this;
    }
}