<?php

class Member
{
    public function __construct(
        public string $login,
        public string $password,
        public int $age
    ) {
    }

    public function auth(string $login, string $password): bool
    {
        if ($this->login !== $login) {
            return false;
        }

        if ($this->password !== $password) {
            return false;
        }

        return true;
    }
}
