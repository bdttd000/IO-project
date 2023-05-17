<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_profile WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        $creationDate = new DateTime($user['creationDate']);
        $creationDate = $creationDate->format('Y-m-d');

        $avatarUrl = $user['avatarUrl'] ?: "";
        $description = $user['description'] ?: "";

        return new User(
            intval($user['userID']),
            $user['nickname'],
            $user['email'],
            $user['password'],
            $creationDate,
            $avatarUrl,
            $description
        );
    }

    public function checkUser(string $nickname, string $email): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_profile WHERE LOWER(nickname) = :nickname OR LOWER(email) = :email
        ');

        $stmt->bindParam(':nickname', strtolower($nickname), PDO::PARAM_STR);
        $stmt->bindParam(':email', strtolower($email), PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return (bool) $user;
    }

    public function addUser(string $nickname, string $email, string $password): void
    {
        $id = $this->getNextId();
        $creationDate = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_profile (userid, nickname, email, password, creationdate) VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $id,
            $nickname,
            $email,
            md5($password),
            $creationDate->format('Y-m-d')
        ]);
    }

    public function getNextId(): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT max(userid) FROM user_profile
        ');
        $stmt->execute();

        $output = $stmt->fetch(PDO::FETCH_ASSOC);

        return $output['max'] + 1 ?: 1;
    }
}