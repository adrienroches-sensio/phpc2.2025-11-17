<?php

namespace App\Membership;

use App\User;
use Faker\Generator;
use IteratorAggregate;
use Traversable;
use function random_int;

class EmulatedDatabaseMemberCollection implements IteratorAggregate
{
    private array $members = [];

    public function __construct(
        private Generator $faker,
        private int       $total = 10,
    ) {
    }

    public function getIterator(): Traversable
    {
        if ($this->members === []) {
            for ($i = 0; $i < $this->total; $i++) {
                $this->members[] = new Member(
                    new User($this->faker->name()),
                    $this->faker->userName(),
                    $this->faker->password(),
                    random_int(25, 55),
                );
            }
        }

        return new \ArrayIterator($this->members);
    }
}
