<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once 'SessionController.php';

class UserController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/avatars/';
    private static $messages = [];
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function profile($query = null)
    {
        if (!$query) {
            $this->redirectToHome();
        }

        parse_str($query, $userid);
        $user = $this->userRepository->getUserById(intval($userid['userid']));

        if (!$user) {
            $this->redirectToHome();
        }

        $this->render('profile', ['userid' => $userid['userid'], 'user' => $user]);
    }

    public function editProfile()
    {
        $this->render('editProfile');
    }

    public function editProfileForm()
    {
        if (!$this->isPost()) {
            return $this->redirectToHome();
        }

        $sessionController = new SessionController();
        $userInfo = $sessionController->unserializeUser();

        if (is_uploaded_file($_FILES['avatar']['tmp_name']) && $this->validateFile($_FILES['avatar'])) {
            $newUrl = $this->userRepository->generateID() . '.' . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

            move_uploaded_file(
                $_FILES['avatar']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $newUrl
            );

            if ($userInfo->getAvatarUrl() != '') {
                unlink(dirname(__DIR__) . self::UPLOAD_DIRECTORY . $userInfo->getAvatarUrl());
            }

            $userInfo->setAvatarUrl($newUrl);
        } else {
            $newUrl = $userInfo->getAvatarUrl();
        }

        if ($_POST['description'] !== $userInfo->getDescription()) {
            $userInfo->setDescription($_POST['description']);
        }

        $_SESSION["user_info"] = serialize($userInfo);

        $this->userRepository->editUser(
            $newUrl,
            $_POST['description'],
            $userInfo->getUserID()
        );

        $this->profile('userid=' . $userInfo->getUserID());
    }

    private function validateFile(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            array_push(self::$messages, 'Plik jest za duży');
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            array_push(self::$messages, 'Rozszerzenie pliku jest niedozwolone');
            return false;
        }

        return true;
    }
}