<?php


namespace InterviewCamp\ArrayConcepts;

$input = [1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 4, 5, 6, 7, 8];
$target = 3;

$search = new BinarySearch();

$result = $search->findFirstMatch($input, $target);

if ($result >= 0) {
    print "\nTarget found at index: {$result}\n";
} else {
    print "\nTarget not found in array\n";
}

class BinarySearch
{
    private function getMidpointIndex(int $start, int $end): int
    {
        // $mid = ($start + $end)/2 -- The intuitive calculation risks integer overflow
        // This will avoid integer overflow bugs
        return floor($start + ($end - $start) / 2);
    }


    public function binarySearch(array $values, int $target): int
    {
        $start = 0;
        $end = count($values) - 1;

        while ($start <= $end) {
            $mid_index = $this->getMidpointIndex($start, $end);
            $middle_value = $values[$mid_index];

            if ($middle_value == $target) {
                return $mid_index;
            } elseif ($middle_value < $target) {
                $start = $mid_index + 1;
            } else {
                $end = $mid_index - 1;
            }
        }

        // $target not found
        return -1;
    }

    public function findFirstMatch(array $values, int $target): int
    {
        $start = 0;
        $end = count($values) - 1;

        while ($start <= $end) {
            $mid_index = $this->getMidpointIndex($start, $end);
            $middle_value = $values[$mid_index];

            if ($middle_value < $target) {
                $start = $mid_index + 1;
            } elseif (
                $middle_value > $target
                || ($middle_value == $target && $mid_index > 0 && $values[$mid_index - 1] == $target)
            ) {
                $end = $mid_index - 1;
            } else {
                return $mid_index;
            }
        }

        // $target not found
        return -1;
    }

}