<?php

$input = [
    [1, 2, 3, 4, 5],
    [1, 2, 3, 4, 5],
    [1, 2, 3, 4, 5]
];

try {
    $zig_zag = new ZigZag($input);
    $zig_zag->printZigZag();

} catch (Exception $e) {
    print $e->getMessage();
}

class ZigZag
{
    const ZIG = 'zig'; // up/right
    const ZAG = 'zag'; // down/left

    private $array;
    private $height;
    private $width;

    private $row = 0;
    private $col = 0;

    private $direction = self::ZIG;

    public function __construct(array $array)
    {
        $this->array = $array;
        $this->height = count($array) - 1;
        $this->width = count($array[0]) - 1;
    }

    public function printZigZag()
    {
        print PHP_EOL.implode(', ', $this->getZigZagOrder()).PHP_EOL;
    }

    public function getZigZagOrder(): array
    {
        $output = [$this->array[$this->row][$this->col]];
        while ($this->row < $this->height || $this->col < $this->width) {
            $output[] = $this->getNextValue();
        }

        return $output;
    }

    private function getNextValue(): int
    {
        if ($this->isAtBoundary()) {
            $this->reverse();
        } elseif ($this->direction == self::ZIG) {
            $this->row--;
            $this->col++;
        } else {
            $this->row++;
            $this->col--;
        }

        return $this->array[$this->row][$this->col];
    }

    private function isAtBoundary(): bool
    {
        if (
            $this->direction == self::ZIG &&
            ($this->row <= 0 || $this->col >= $this->width)
        ) {
            return true;
        } elseif (
            $this->direction == self::ZAG &&
            ($this->col <= 0 || $this->row >= $this->height)
        ) {
            return true;
        } else {
            return false;
        }
    }

    private function reverse()
    {
        if ($this->direction == self::ZIG) {
            if ($this->row == 0 && $this->col == $this->width) {
                $this->row++;
            } elseif ($this->row <= 0) {
                $this->col++;
            } else {
                $this->row++;
            }

            $this->direction = self::ZAG;
        } else {
            if ($this->col == 0 && $this->row == $this->height) {
                $this->col++;
            } elseif ($this->col <= 0) {
                $this->row++;
            } else {
                $this->col++;
            }

            $this->direction = self::ZIG;
        }
    }
}