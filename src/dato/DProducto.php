<?php
require_once __DIR__ . '/../config/DBHelper.php';

class DProducto
{
    private DBHelper $dbhelper;
    private int $codigo;
    private string $nombre;
    private float $preciocompra;
    private float $preciodeventa;
    private string $tipoproducto;
    private string $estado;
    private string $table;

    public function __construct(string $table)
    {
        $this->codigo = 0;
        $this->nombre = "";
        $this->preciocompra = 0.0;
        $this->preciodeventa = 0.0;
        $this->tipoproducto = "";
        $this->estado = "registrado"; // Estado por defecto
        $this->table = $table;
        $this->dbhelper = new DBHelper();
        $this->createTable();
    }

    private function createTable(): void
    {
        $createStatement = "
            codigo SERIAL PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            preciocompra FLOAT NOT NULL,
            preciodeventa FLOAT NOT NULL,
            tipoproducto VARCHAR(50) NOT NULL,
            estado VARCHAR(50) NOT NULL
        ";
        $this->dbhelper->createTable($this->table, $createStatement);
    }

    public function create(string $nombre, float $preciocompra, float $preciodeventa, string $tipoproducto, string $estado = 'registrado'): void
    {   
        try {
            $conn = $this->dbhelper->createConnection();
            $conn->beginTransaction();
            $stm = $conn->prepare("INSERT INTO $this->table (nombre, preciocompra, preciodeventa, tipoproducto, estado) VALUES (:nombre, :preciocompra, :preciodeventa, :tipoproducto, :estado)");
            $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stm->bindParam(':preciocompra', $preciocompra);
            $stm->bindParam(':preciodeventa', $preciodeventa);
            $stm->bindParam(':tipoproducto', $tipoproducto, PDO::PARAM_STR);
            $stm->bindParam(':estado', $estado, PDO::PARAM_STR);
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

    public function update(int $codigo, string $nombre, float $preciocompra, float $preciodeventa, string $tipoproducto, string $estado): void
    {
        try {
            $conn = $this->dbhelper->createConnection();
            $conn->beginTransaction();
            $stm = $conn->prepare("UPDATE $this->table SET nombre = :nombre, preciocompra = :preciocompra, preciodeventa = :preciodeventa, tipoproducto = :tipoproducto, estado = :estado WHERE codigo = :codigo");
            $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stm->bindParam(':preciocompra', $preciocompra);
            $stm->bindParam(':preciodeventa', $preciodeventa);
            $stm->bindParam(':tipoproducto', $tipoproducto, PDO::PARAM_STR);
            $stm->bindParam(':estado', $estado, PDO::PARAM_STR); // Asignar nuevo estado
            $stm->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stm->execute();
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Error updating record: " . $e->getMessage());
        }
    }

    public function findById(int $codigo)
    {
        try {
            $conn = $this->dbhelper->createConnection();
            $stm = $conn->prepare("SELECT * FROM $this->table WHERE codigo = :codigo");
            $stm->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result ?: null;
        } catch (PDOException $e) {
            throw new Exception("Error fetching record: " . $e->getMessage());
        }
    }

    public function delete(int $codigo): void
    {
        try {
            $conn = $this->dbhelper->createConnection();
            $conn->beginTransaction();
            $stm = $conn->prepare("DELETE FROM $this->table WHERE codigo = :codigo");
            $stm->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stm->execute();
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Error deleting record: " . $e->getMessage());
        }
    }
}
?>
