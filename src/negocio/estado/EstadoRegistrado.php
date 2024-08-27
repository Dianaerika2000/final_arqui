<?php
require_once __DIR__ . './Estado.php';
class EstadoRegistrado extends Estado
{
    public function revisar(): void
    {
        $this->contexto->setEstado(new EstadoRevisado($this->contexto));
    }

    public function guardar(): void
    {
        throw new Exception("No se puede guardar un producto en estado Registrado.");
    }

    public function puedeActualizar(): bool
    {
        return true;
    }

    public function getEstado(): string
    {
        return 'registrado';
    }
}

?>
