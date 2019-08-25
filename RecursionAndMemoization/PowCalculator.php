<?php

namespace InterviewCamp\RecursionAndMemoization;

$base = 13;
$power = 45;

$calc = new PowCalculator();

print "{$base}^{$power} = {$calc->recusivePow($base, $power)}\n";

class PowCalculator
{

    public function recusivePow(int $base, int $power, array &$memo = [])
    {
        if (isset($memo[$power])) {
            return $memo[$power];
        }

        if ($power == 1) {
            $result = $base;
        } elseif ($power % 2 != 0) {
            $result = $base * $this->recusivePow($base, $power-1, $memo);
        } else {
            $result = $this->recusivePow($base, $power / 2, $memo) * $this->recusivePow($base, $power / 2, $memo);
        }

        $memo[$power] = $result;

        return $result;
    }
}