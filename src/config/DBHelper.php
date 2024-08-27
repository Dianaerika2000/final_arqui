<?php

class DBHelper
{
    private $DATABASE_HOST = "localhost";
    private $DATABASE_NAME = "parcial";
    private $DATABASE_USER = "postgres";
    private $DATABASE_PASSWORD = "toor";

    public function createConnection()
    {
        try {
            $pdo = new PDO("pgsql:host={$this->DATABASE_HOST};port=5432;dbname={$this->DATABASE_NAME}", $this->DATABASE_USER, $this->DATABASE_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function createTable(string $tableName, string $createStatement): void
    {
        try {
            $conn = $this->createConnection();
            $sql = "CREATE TABLE IF NOT EXISTS $tableName ($createStatement)";
            $conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error creating table: " . $e->getMessage());
        }
    }
}
?>
