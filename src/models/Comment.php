<?php

class Comment
{
    private $commentID;
    private $memeID;
    private $userID;
    private $content;
    private $creationDate;

    public function __construct(
        int $commentID,
        int $memeID,
        int $userID,
        string $content,
        string $creationDate
    ) {
        $this->commentID = $commentID;
        $this->memeID = $memeID;
        $this->userID = $userID;
        $this->content = $content;
        $this->creationDate = $creationDate;
    }

    public function getCommentID(): int
    {
        return $this->commentID;
    }

    public function getMemeID(): int
    {
        return $this->memeID;
    }

    public function getUserID(): int
    {
        return $this->userID;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }
}