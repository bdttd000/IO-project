<?php

class User
{
    private $userID;
    private $nickname;
    private $email;
    private $password;
    private $creationDate;
    private $avatarUrl;
    private $description;

    public function __construct(
        int $userID,
        string $nickname,
        string $email,
        string $password,
        string $creationDate,
        $avatarUrl,
        $description
    ) {
        $this->userID = $userID;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
        $this->creationDate = $creationDate;
        $this->avatarUrl = $avatarUrl;
        $this->description = $description;
    }

    public function getUserID(): int
    {
        return $this->userID;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatarUrl;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}