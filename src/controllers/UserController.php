<?php

require_once 'AppController.php';
// require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
// require_once 'SessionController.php';

class UserController extends AppController
{
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
}