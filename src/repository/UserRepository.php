<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_profile WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(...array_values($user));
    }

    public function getUserById(int $userid): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_profile WHERE userid = :userid
        ');
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(...array_values($user));
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
        $id = $this->getNextId('user_profile', 'userid');
        $creationDate = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_profile (userid, nickname, email, password, creationdate) VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $id,
            $nickname,
            $email,
            hash('sha256', $password),
            $creationDate->format('Y-m-d')
        ]);
    }

    public function editUser(string $newUrl, string $description, int $userid): void
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE user_profile SET avatarurl = :avatarurl, description = :description WHERE userid = :userid
        ');

        $stmt->bindParam(':avatarurl', $newUrl, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
    }
}