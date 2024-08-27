<?php
require_once __DIR__ . './Estado.php';

class EstadoRevisado extends Estado
{
    public function revisar(): void
    {
        throw new Exception("El producto ya está revisado.");
    }

    public function guardar(): void
    {
        $this->contexto->setEstado(new EstadoGuardado($this->contexto));
    }

    public function puedeActualizar(): bool
    {
        return true;
    }

    public function getEstado(): string
    {
        return 'revisado';
    }
}
?>
