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
}