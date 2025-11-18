<?php

namespace Membership;

final class NotAuthenticatableMember
{
    public function __construct(
        public string $name,
    ) {
    }
}
