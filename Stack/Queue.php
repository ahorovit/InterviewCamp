<?php


namespace InterviewCamp\Stack;


class Queue
{
    /** @var Stack */
    protected $stack_1;

    /** @var Stack */
    protected $stack_2;

    public function enqueue($value)
    {
        $this->stack_1->push($value);
    }

    public function dequeue()
    {
        if($this->stack_2->empty())
        {
            $this->flushToStack2();
        }

        return $this->stack_2->pop();
    }

    public function peek()
    {
        if ($this->stack_2->empty()) {
            $this->flushToStack2();
        }

        return $this->stack_2->peek();
    }

    public function empty(): bool {
        return $this->stack_1->empty() && $this->stack_2->empty();
    }

    private function flushToStack2()
    {
        while (!$this->stack_1->empty()) {
            $this->stack_2->push($this->stack_1->pop());
        }
    }


}