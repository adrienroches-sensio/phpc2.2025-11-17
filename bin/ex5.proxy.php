<?php

class Randomizer
{
    public function numbers(int $count): array
    {
        $result = [];

        foreach (range(1, $count) as $i) {
            $result[] = random_int(1, 100);
        }

        return $result;
    }
}

class CachedRandomizer
{
    private array $cachedNumbers;

    public function __construct(
        private Randomizer $randomizer
    ) {
    }

    public function numbers(int $count): array
    {
        return $this->cachedNumbers ??= $this->randomizer->numbers($count);
    }
}

echo 'Default randomizer:'. PHP_EOL;
$randomizer = new Randomizer();
var_dump(
    $randomizer->numbers(3),
    $randomizer->numbers(3),
    $randomizer->numbers(3),
);

echo PHP_EOL.PHP_EOL.'Cached randomizer:'. PHP_EOL;
$cachedRandomizer = new CachedRandomizer($randomizer);
var_dump(
    $cachedRandomizer->numbers(3),
    $cachedRandomizer->numbers(3),
    $cachedRandomizer->numbers(3),
);
