<?php

class User
{
    private $nickname;
    private $email;
    private $password;

    public function __construct(string $nickname, string $email, string $password)
    {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}