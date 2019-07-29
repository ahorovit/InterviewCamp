<?php
// EASY problem
$input = [2, 3, 0, 3, 0, 1, 0, 2, 3, 0, 3, 0, 1, 0, 2, 3, 0, 3, 0, 1, 0, 2, 3, 0, 3, 0, 1, 0];
$sorter = new ZeroSorter($input);
$sorter->moveZeroesToTheRight()->print();

// MEDIUM problem
$input = [1, 0, 1, 2, 1, 0, 1, 2, 1, 0, 1, 2, 1, 0, 1, 2, 1, 0, 1, 2, 1, 0, 1, 2, 1, 0, 1, 2];
$sorter = new ColorSorter($input);
$sorter->sortRedWhiteBlue()->print();

abstract class BaseDutchFlagSorter
{
    protected $data;

    protected $right_pointer;
    protected $left_pointer = 0;

    public function __construct(array $input)
    {
        $this->data = $input;
        $this->right_pointer = count($input) - 1;
    }

    protected function swap(int $pointer_1, int $pointer_2): void
    {
        $temp = $this->data[$pointer_1];
        $this->data[$pointer_1] = $this->data[$pointer_2];
        $this->data[$pointer_2] = $temp;
    }

    public function print()
    {
        print static::class . ': [' . implode(',', $this->data) . ']' . PHP_EOL;
    }
}

class ColorSorter extends BaseDutchFlagSorter
{
    const RED = 0;
    const WHITE = 1;
    const BLUE = 2;

    private $mid_pointer = 0;

    public function sortRedWhiteBlue()
    {
        while ($this->mid_pointer <= $this->right_pointer) {
            if ($this->data[$this->mid_pointer] == self::RED) {
                $this->swap($this->mid_pointer, $this->left_pointer);
                $this->left_pointer++;
                $this->mid_pointer++;
            } elseif ($this->data[$this->mid_pointer] == self::WHITE) {
                $this->mid_pointer++;
            } else {
                $this->swap($this->mid_pointer, $this->right_pointer);
                $this->right_pointer--;
            }
        }

        return $this;
    }

}

class ZeroSorter extends BaseDutchFlagSorter
{
    public function moveZeroesToTheRight(): self
    {
        while ($this->left_pointer <= $this->right_pointer) {
            if ($this->data[$this->left_pointer] == 0) {
                $this->swap($this->right_pointer, $this->left_pointer);
                $this->right_pointer--;
            } else {
                $this->left_pointer++;
            }
        }

        return $this;
    }
}