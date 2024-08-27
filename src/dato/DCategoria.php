<?php
require_once __DIR__ . '\..\config\DBHelper.php';

class DCategoria
{
    private DBHelper $dbhelper;
    private int $id;
    private string $descripcion;
    private string $table;

    public function __construct(string $table)
    {
        $this->id = 0;
        $this->descripcion = "";
        $this->table = $table;
        $this->dbhelper = new DBHelper();
        $this->createTable();
    }

    private function createTable(): void
    {
        $createStatement = "
            id SERIAL PRIMARY KEY,
            descripcion VARCHAR(255) NOT NULL
        ";
        $this->dbhelper->createTable($this->table, $createStatement);
    }

    public function create(string $descripcion): void
    {
        try {
            $conn = $this->dbhelper->createConnection();
            $conn->beginTransaction();
            $stm = $conn->prepare("INSERT INTO $this->table (descripcion) VALUES (:descripcion)");
            $stm->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stm->execute();
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Error creating record: " . $e->getMessage());
        }
    }

    public function findAll(): array
    {
        try {
            $conn = $this->dbhelper->createConnection();
            $stm = $conn->prepare("SELECT * FROM $this->table");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error fetching records: " . $e->getMessage());
        }
    }

    public function update(int $id, string $descripcion): void
    {
        try {
            $conn = $this->dbhelper->createConnection();
            $conn->beginTransaction();
            $stm = $conn->prepare("UPDATE $this->table SET descripcion = :descripcion WHERE id = :id");
            $stm->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Error updating record: " . $e->getMessage());
        }
    }

    public function findById(int $id)
    {
        try {
            $conn = $this->dbhelper->createConnection();
            $stm = $conn->prepare("SELECT * FROM $this->table WHERE id = :id");
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result ?: null;
        } catch (PDOException $e) {
            throw new Exception("Error fetching record: " . $e->getMessage());
        }
    }

    public function delete(int $id): void
    {
        try {
            $conn = $this->dbhelper->createConnection();
            $conn->beginTransaction();
            $stm = $conn->prepare("DELETE FROM $this->table WHERE id = :id");
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Error deleting record: " . $e->getMessage());
        }
    }
}
?>
