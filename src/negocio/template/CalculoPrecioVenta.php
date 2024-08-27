<?php
abstract class CalculoPrecioVenta
{
    // Método de plantilla
    public function calcularPrecioVenta(float $preciocompra): float
    {
        $precioVenta = $this->calcular($preciocompra);
        return $precioVenta;
    }

    // Método abstracto que será implementado por las subclases
    protected abstract function calcular(float $preciocompra): float;
}
?>
