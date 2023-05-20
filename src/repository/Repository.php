<?php

require_once __DIR__ . '/../../Database.php';

class Repository
{
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getNextId($table_name, $cell_name): int
    {
        $stmt = $this->database->connect()->prepare("
            SELECT max(" . $cell_name . ") FROM " . $table_name . "
        ");
        $stmt->execute();

        $output = $stmt->fetch(PDO::FETCH_ASSOC);

        return $output['max'] + 1 ?: 1;
    }
}