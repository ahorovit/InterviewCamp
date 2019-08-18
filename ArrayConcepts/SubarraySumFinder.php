<?php

namespace InterviewCamp\ArrayConcepts;


$finder = new SubarraySumFinder();

// MAX contiguous subarray
//$input = [-2, -3, 4, -1, -2, 1, 5, -1];
//
////$max_sum = $finder->findMaxSubarraySum($input);
//$max_sum = $finder->findMaxSubarraySumInPlace($input);
//$max_subarray = $finder->findMaxSubarray($input);
//
//print_r([
//    'sum' => $max_sum,
//    'subarray' => $max_subarray
//]);

// Subarray that sums to target input

// All positive values
//$input = [2, 1, 4, 5, 3, 5, 1, 2, 4];
//$target = 30;
//$subarray = $finder->findSubarrayWithTargetSumAllPositive($input, $target);

$input = [-1, -1, 2, 1, -4, 2, 3, -1, 2];
$target = 5;
$subarray = $finder->findSubarrayWithTargetSumNegativeAllowed($input, $target);

print_r([
    'target' => $target,
    'subarray' => $subarray
]);

class SubarraySumFinder
{
    public function findMaxSubarraySum(array $input): int
    {
        $max_at_i = [];
        $max_sum = 0;
        foreach ($input as $i => $value) {
            $last_max = $max_at_i[$i - 1] ?? 0;
            $this_max = max(0, $last_max + $value);

            if ($this_max > $max_sum) {
                $max_sum = $this_max;
            }

            $max_at_i[] = $this_max;
        }

        return $max_sum;
    }

    public function findMaxSubarraySumInPlace(array $input): int
    {
        $last_max_sum = 0;
        $max_sum = 0;
        foreach ($input as $i => $value) {
            $this_max = max(0, $last_max_sum + $value);
            $last_max_sum = $this_max;

            if ($this_max > $max_sum) {
                $max_sum = $this_max;
            }
        }

        return $max_sum;
    }

    public function findMaxSubarray(array $input): array
    {
        $max_at_i_minus_1 = 0;
        $max_sum_overall = 0;

        $start = null;
        $end = null;
        foreach ($input as $i => $value) {
            $max_at_i = max(0, $max_at_i_minus_1 + $value);
            $max_at_i_minus_1 = $max_at_i;

            if ($max_at_i > $max_sum_overall) {
                $max_sum_overall = $max_at_i;
                $this->updateBoundaries($start, $end, $i);
            }
        }

        return array_slice($input, $start, $end - $start + 1);
    }

    private function updateBoundaries(?int &$start, ?int &$end, int $i)
    {
        if (is_null($start)) {
            $start = $i;
        } else {
            $start = $end;
        }
        $end = $i;
    }

    // NOTE: this only works if all values are positive
    public function findSubarrayWithTargetSumAllPositive(array $input, int $target): array
    {
        $start = 0;
        $end = -1;
        $current_sum = 0;
        $boundary = count($input) - 1;

        while ($start < $boundary) {
            if ($current_sum < $target) {
                if ($end < $boundary) {
                    $end++;
                    $current_sum += $input[$end];
                } else {
                    break; // If the entire array is less than target
                }
            } elseif ($current_sum > $target) {
                $current_sum -= $input[$start];
                $start++;
            } else {
                return array_slice($input, $start, $end - $start + 1);
            }
        }
        return [-1, -1];
    }

    public function findSubarrayWithTargetSumNegativeAllowed(array $input, int $target): array
    {
        $common_diff_map = [];
        $current_sum = 0;

        foreach ($input as $i => $value) {
            $current_sum += $value;

            if ($current_sum == $target) {
                return array_slice($input, 0, $i + 1);
            }

            $matching_start_sum = $current_sum - $target;
            if (isset($common_diff_map[$matching_start_sum])) {
                $start = $common_diff_map[$matching_start_sum];
                return array_slice($input, $start + 1, $i - $start);
            } else {
                $common_diff_map[$current_sum] = $i;
            }
        }

        return [-1, -1];
    }
}