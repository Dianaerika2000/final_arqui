<?php
require_once 'CalculoPrecioVenta.php';

class CalculoPrecioVentaBebida extends CalculoPrecioVenta
{
    protected function calcular(float $preciocompra): float
    {
        return $preciocompra * 1.10; 
    }
}
?>
