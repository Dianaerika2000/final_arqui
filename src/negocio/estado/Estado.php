<?php
require_once __DIR__ . '/../NProducto.php';

?><?php

abstract class Estado
{
    protected NProducto $contexto;

    public function __construct(NProducto $contexto)
    {
        $this->contexto = $contexto;
    }

    abstract public function revisar(): void;
    abstract public function guardar(): void;
    abstract public function puedeActualizar(): bool;
    abstract public function getEstado(): string; // Método para obtener el estado actual
}

?>

