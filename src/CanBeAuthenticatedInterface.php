<?php

interface CanBeAuthenticatedInterface
{
    public function auth(string $login, string $password): bool;
}
