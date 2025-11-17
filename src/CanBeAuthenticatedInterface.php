<?php

interface CanBeAuthenticatedInterface
{
    /**
     * @throws AuthenticationFailedException If login is incorrect.
     * @throws AuthenticationFailedException If password is incorrect.
     */
    public function auth(string $login, string $password): void;
}
