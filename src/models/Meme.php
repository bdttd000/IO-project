<?php

class Meme
{
    private $memeid;
    private $userid;
    private $title;
    private $photourl;
    private $creationDate;
    private $evaluated;
    private $evaluationdate;

    public function __construct(
        int $memeid,
        int $userid,
        string $title,
        string $photourl,
        string $creationDate,
        string $evaluated,
        string $evaluationdate
    ) {
        $this->memeid = $memeid;
        $this->userid = $userid;
        $this->title = $title;
        $this->photourl = $photourl;
        $this->creationDate = $creationDate;
        $this->evaluated = $evaluated;
        $this->evaluationdate = $evaluationdate;
    }

    public function getMemeID(): int
    {
        return $this->memeid;
    }

    public function getUserID(): int
    {
        return $this->userid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPhotoUrl(): string
    {
        return $this->photourl;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function getEvaluated(): string
    {
        return $this->evaluated;
    }

    public function getEvaluationDate(): string
    {
        return $this->evaluationdate;
    }
}