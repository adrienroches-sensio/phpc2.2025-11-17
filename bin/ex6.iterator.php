<?php

class StepIterator implements IteratorAggregate
{
    public function __construct(
        private iterable $iterable,
        private int $step = 1,
    ) {
    }

    public function getIterator(): Traversable
    {
        $counter = 1;

        foreach ($this->iterable as $key => $value) {
            $mustSkip = ($counter % $this->step) !== 0;
            $counter++;

            if ($mustSkip === true) {
                continue;
            }

            yield $key => $value;
        }
    }
}

$values = range(1, 15);
$iterator = new StepIterator($values, 3);

foreach ($iterator as $key => $value) {
    echo "$key => $value\n";
}
