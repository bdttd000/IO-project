<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Meme.php';
require_once __DIR__ . '/../repository/MemeRepository.php';
require_once __DIR__ . '/../repository/AdRepository.php';
require_once 'SessionController.php';

class MemeController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/memes/';
    private static $messages = [];
    private $memeRepository;
    private $adRepository;
    private $memesPerPage = 10;

    public function __construct()
    {
        parent::__construct();
        $this->adRepository = new AdRepository();
        $this->memeRepository = new MemeRepository();
    }

    public function home($query = 'page=1')
    {
        parse_str($query, $pageNumber);
        $memes = $this->memeRepository->getMemes(intval($pageNumber['page']), $this->memesPerPage, 0);
        $ads = $this->adRepository->getAds(5);
        $pagesCount = ceil($this->memeRepository->memesCount() / $this->memesPerPage);
        $this->render('home', ['pageNumber' => $pageNumber['page'], 'memes' => $memes, 'ads' => $ads, 'pagesCount' => $pagesCount]);
    }

    public function meme($query = null)
    {
        if (!$query) {
            $memeid = $this->memeRepository->getRandomMemeID();
        } else {
            parse_str($query, $memeid);
            $memeid = $memeid['memeid'];
        }

        $ads = $this->adRepository->getAds(2);
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