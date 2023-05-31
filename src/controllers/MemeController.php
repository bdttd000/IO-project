<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Meme.php';
require_once __DIR__ . '/../repository/MemeRepository.php';
require_once __DIR__ . '/../repository/AdRepository.php';
require_once __DIR__ . '/../repository/CommentRepository.php';
require_once 'SessionController.php';

class MemeController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/memes/';
    private static $messages = [];
    private $memeRepository;
    private $adRepository;
    private $sessionController;
    private $commentRepository;
    private $memesPerPage = 10;

    public function __construct()
    {
        parent::__construct();
        $this->adRepository = new AdRepository();
        $this->memeRepository = new MemeRepository();
        $this->commentRepository = new CommentRepository();
        $this->sessionController = new SessionController();
    }

    public function home($query = 'page=1')
    {
        parse_str($query, $query);
        $page = intval($query['page']);
        $evaluated = 1;

        $memes = $this->memeRepository->getMemes($page, $this->memesPerPage, $evaluated);
        $ads = $this->adRepository->getAds(5);
        $pagesCount = ceil($this->memeRepository->memesCount($evaluated) / $this->memesPerPage);
        $this->render('home', ['pageNumber' => $page, 'memes' => $memes, 'ads' => $ads, 'pagesCount' => $pagesCount]);
    }

    public function waitingRoom($query = 'page=1')
    {
        parse_str($query, $query);
        $page = intval($query['page']);
        $evaluated = 2;

        $memes = $this->memeRepository->getMemes($page, $this->memesPerPage, $evaluated);
        $ads = $this->adRepository->getAds(5);
        $pagesCount = ceil($this->memeRepository->memesCount($evaluated) / $this->memesPerPage);
        $this->render('waitingRoom', ['pageNumber' => $page, 'memes' => $memes, 'ads' => $ads, 'pagesCount' => $pagesCount]);
    }

    public function userMemes($query = 'userid=1&page=1')
    {
        parse_str($query, $query);
        $userid = intval($query['userid']);
        $page = intval($query['page']);

        $memes = $this->memeRepository->getMemes($page, $this->memesPerPage, 0, $userid);
        $ads = $this->adRepository->getAds(5);
        $pagesCount = ceil($this->memeRepository->memesCount(0, $userid) / $this->memesPerPage);
        $this->render('userMemes', ['pageNumber' => $page, 'memes' => $memes, 'ads' => $ads, 'pagesCount' => $pagesCount, 'userid' => $userid]);
    }

    public function favorites($query = 'page=1')
    {
        parse_str($query, $query);
        $page = intval($query['page']);

        $userInfo = $this->sessionController->unserializeUser();
        if (!$userInfo || !$userInfo->getUserID()) {
            $this->render('login');
        }

        $userid = $userInfo->getUserID();

        $followedMemes = $this->memeRepository->getFollowedMemesIds($userid);

        $memes = [];
        foreach ($followedMemes as $memeid) {
            array_push($memes, $this->memeRepository->getMemeByID($memeid));
        }

        $memes = array_slice($memes, $page * 10 - 10, 10);

        $pagesCount = ceil(count($followedMemes) / $this->memesPerPage);
        $this->render('favorites', ['pageNumber' => $page, 'memes' => $memes, 'pagesCount' => $pagesCount, 'userid' => $userid]);
    }

    public function meme($query = null)
    {
        if (!$query) {
            $memeid = $this->memeRepository->getRandomMemeID();
        } else {
            parse_str($query, $memeid);
            $memeid = $memeid['memeid'];
        }

        $ads = $this->adRepository->getAds(1);
        $meme = $this->memeRepository->getMemeByID($memeid);

        $this->render('meme', ['meme' => $meme, 'ads' => $ads]);
    }

    public function addMemeForm()
    {
        if (
            !(
                $this->isPost()
                && is_uploaded_file($_FILES['meme']['tmp_name'])
                && $this->validateFile($_FILES['meme'])
                && $this->validateTitle($_POST['title'])
            )
        ) {
            return $this->redirectToHome();
        }

        $newUrl = $this->memeRepository->generateID() . '.' . pathinfo($_FILES['meme']['name'], PATHINFO_EXTENSION);

        move_uploaded_file(
            $_FILES['meme']['tmp_name'],
            dirname(__DIR__) . self::UPLOAD_DIRECTORY . $newUrl
        );

        $this->memeRepository->addMeme(
            $_POST['title'],
            $newUrl
        );

        return $this->redirectToHome();
    }

    public function likesAction()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType !== "application/json") {
            return;
        }

        $content = trim(file_get_contents("php://input"));
        [$action, $memeid] = json_decode($content, true);

        if ($action === 'addLike') {
            $output = $this->memeRepository->addLike(intval($memeid));
        } else {
            $output = $this->memeRepository->addDislike(intval($memeid));
        }

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($output);
    }

    public function favoritesAction()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType !== "application/json") {
            return;
        }

        $content = trim(file_get_contents("php://input"));
        $memeid = json_decode($content, true);

        $output = $this->memeRepository->addFavorites(intval($memeid));

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($output);
    }

    public function validateComment()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType !== "application/json") {
            return;
        }

        if ($userInfo = $this->sessionController->unserializeUser()) {
            $executionerid = $userInfo->getUserID() ?: 0;
        } else {
            return;
        }

        $content = trim(file_get_contents("php://input"));
        [$memeid, $content] = json_decode($content, true);

        $output = $this->commentRepository->addComment(intval($memeid), $executionerid, $content);
        $output['usernickname'] = $userInfo->getNickname();
        $output['useravatar'] = $userInfo->getAvatarUrl();

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($output);
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

    private function validateTitle(string $title): bool
    {
        if (strlen($title) < 3) {
            array_push(self::$messages, 'Tytuł jest za krótki');
            return false;
        }

        if (strlen($title) > 50) {
            array_push(self::$messages, 'Tytuł jest za długi');
            return false;
        }

        return true;
    }
}