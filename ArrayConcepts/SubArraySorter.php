<?php

namespace InterviewCamp\ArrayConcepts;


$input = [1, 12, 8, 6, 5, 7, 10];
$input = [1, 12, 8, 6, 5, 7, 10];
$sorter = new SubArraySorter($input);

$sorter->printUnsortedSubarray();

abstract class BaseSubArraySorter
{
    protected $input;
    protected $input_end;

    public function __construct(array $input)
    {
        $this->input = $input;
        $this->input_end = count($input) - 1;
    }

    abstract public function printUnsortedSubarray(): void;

}

// @todo: implement O(n) solution
class InPlaceSubArraySorter extends BaseSubArraySorter
{
    /**
     * Traverse in from both ends
     * -->find first dip from the left (i)
     * -->find first bump from the right (j)
     * -->find min/max in i-j subarray
     * -->expand left bound to include elements above subarray_min
     * -->expand right bound to include elements below subarray_max
     */
    public function printUnsortedSubarray(): void
    {
        // TODO: Implement printUnsortedSubarray() method.
    }
}

// O(n log n)
class BruteForceSubArraySorter extends BaseSubArraySorter
{
    public function printUnsortedSubarray(): void
    {
//        print implode(',', $this->getUnsortedSubArray()).PHP_EOL;
        print "[".implode(',', $this->getUnsortedBoundaries())."]\n";
    }


    private function getUnsortedSubArray(): array
    {
        list($left, $right) = $this->getUnsortedBoundaries();

        $subarray = array_slice($this->input, $left, ($right - $left + 1));

        return $subarray;
    }

    private function getUnsortedBoundaries()
    {
        $sorted = $this->input;
        sort($sorted);

        $left = 0;
        $right = $this->input_end;

        $right_found = false;
        $left_found = false;

        while (!($right_found && $left_found)) {

            if ($right < $left) {
                throw new Exception("Input is fully sorted");
            }

            if ($sorted[$right] != $this->input[$right]) {
                $right_found = true;
            } else {
                $right--;
            }

            if ($sorted[$left] != $this->input[$left]) {
                $left_found = true;
            } else {
                $left++;
            }
        }

        return [$left, $right];
    }

}