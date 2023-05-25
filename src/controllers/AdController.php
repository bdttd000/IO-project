<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Ad.php';
require_once __DIR__ . '/../repository/AdRepository.php';

class AdController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/ads/';
    private static $messages = [];
    private $adRepository;

    public function __construct()
    {
        parent::__construct();
        $this->adRepository = new AdRepository();
    }

    public function addAdForm()
    {
        if (
            !(
                $this->isPost()
                && is_uploaded_file($_FILES['ad']['tmp_name'])
                && $this->validateFile($_FILES['ad']))
        ) {
            return $this->redirectToHome();
        }

        $dateFrom = date('Y-m-d', strtotime($_POST['dateFrom']));
        $dateTo = date('Y-m-d', strtotime($_POST['dateTo']));

        $newUrl = $this->adRepository->generateID() . '.' . pathinfo($_FILES['ad']['name'], PATHINFO_EXTENSION);

        move_uploaded_file(
            $_FILES['ad']['tmp_name'],
            dirname(__DIR__) . self::UPLOAD_DIRECTORY . $newUrl
        );

        $this->adRepository->addAd(
            $_POST['title'],
            $dateFrom,
            $dateTo,
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
}