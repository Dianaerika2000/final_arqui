<?php
require_once __DIR__ . '\..\dato\DCategoria.php';

class NCategoria
{
    private DCategoria $dCategoria;

    public function __construct()
    {
        $this->dCategoria = new DCategoria("categoria");
    }

    public function create(string $descripcion): void
    {
        $this->dCategoria->create($descripcion);
    }

    public function update(int $id, string $descripcion): void
    {
        $this->dCategoria->update($id, $descripcion);
    }

    public function delete(int $id): void
    {
        $this->dCategoria->delete($id);
    }

    public function getAll(): array
    {
        return $this->dCategoria->findAll();
    }

    public function findById(int $id)
    {
        return $this->dCategoria->findById($id);
    }
}
?>
