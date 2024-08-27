<?php
require_once __DIR__ . './Estado.php';

class EstadoGuardado extends Estado
{
    public function revisar(): void
    {
        throw new Exception("No se puede revisar un producto guardado.");
    }

    public function guardar(): void
    {
        throw new Exception("El producto ya está guardado.");
    }

    public function puedeActualizar(): bool
    {
        return false;
    }

    public function getEstado(): string
    {
        return 'guardado';
    }
}

?>
