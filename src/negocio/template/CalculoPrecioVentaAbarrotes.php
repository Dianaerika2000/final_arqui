<?php
require_once 'CalculoPrecioVenta.php';

class CalculoPrecioVentaAbarrotes extends CalculoPrecioVenta
{
    protected function calcular(float $preciocompra): float
    {
        return $preciocompra * 1.15;
    }
}
?>
