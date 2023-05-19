<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Meme.php';

class MemeController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];

    public function addMemeForm()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['meme']['tmp_name']) && $this->validate($_FILES['meme'])) {
            move_uploaded_file(
                $_FILES['meme']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['meme']['name']
            );
        }

        $meme = new Meme($_POST['title'], $_FILES['meme']['name']);

        return $this->render('home', ['meme' => $meme]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            self::$messages[] = 'Za duzy plik';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            self::$messages[] = 'Rozszerzenie pliku jest niedozwolone';
            return false;
        }

        return true;
    }
}