<?php


namespace InterviewCamp\RecursionAndMemoization;

$denominations = [1,2,5];
$target = 5;

$changer = new CoinChanger($denominations);

$changer->printChangeCombos($target);

class CoinChanger
{
    /** @var array */
    private $denominations;

    /** @var \SplStack */
    private $buffer;

    /** @var array */
    private $current_buffer;

    // @todo: memoize combos for subtargets
    /** @var array */
    private $memo;

    public function __construct(array $denominations)
    {
        sort($denominations);
        $this->denominations = $denominations;
        $this->buffer = new \SplStack();
    }

    public function printChangeCombos(int $target, int $subtarget = null) : void
    {
        if (is_null($subtarget)) {
            $subtarget = $target;
        }

        $current_total = $this->getCurrentTotal();

        // termination cases
        if ($current_total == $target) {
            $this->printBuffer();
            return;
        }

        // identify candidates for buffer
        $candidates = $this->getCandidateCoins($subtarget);

        // iterate through candidates
        foreach ($candidates as $next_coin)
        {
            $this->push($next_coin);

            // recurse on next buffer index
            $this->printChangeCombos($target, $subtarget - $next_coin);

            $this->pop();
        }
    }

    private function push(int $next_coin) : void
    {
        $this->buffer->push($next_coin);
        $this->updateBufferState();
    }

    private function pop(): void
    {
        $this->buffer->pop();
        $this->updateBufferState();
    }

    private function updateBufferState(): void
    {
        $this->current_buffer = [];
        foreach ($this->buffer as $coin) {
            $this->current_buffer[] = $coin;
        }
    }

    private function getCandidateCoins(int $subtarget): array
    {
        $candidates = [];

        foreach ($this->denominations as $value) {
            if ($value <= $subtarget) {
                $candidates[] = $value;
            } else {
                break;
            }
        }

        return $candidates;
    }

    private function getCurrentTotal() : int
    {
        $total = 0;
        foreach ($this->buffer as $coin) {
            $total += $coin;
        }

        return $total;
    }

    private function printBuffer() : void
    {
        foreach ($this->buffer as $coin) {
            print "{$coin} ";
        }

        print "\n";
    }
}