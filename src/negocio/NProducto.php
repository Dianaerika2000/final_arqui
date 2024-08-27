<?php
require_once __DIR__ . '/../dato/DProducto.php';
require_once __DIR__ . '/estado/Estado.php';
require_once __DIR__ . '/estado/EstadoRegistrado.php';
require_once __DIR__ . '/estado/EstadoRevisado.php';
require_once __DIR__ . '/estado/EstadoGuardado.php';
require_once __DIR__ . '/template/CalculoPrecioVenta.php';
require_once __DIR__ . '/template/CalculoPrecioVentaAbarrotes.php';
require_once __DIR__ . '/template/CalculoPrecioVentaBebida.php';

class NProducto
{
    private DProducto $dProducto;
    private Estado $estado;

    public function __construct()
    {
        $this->dProducto = new DProducto("productos");
        $this->estado = new EstadoRegistrado($this); // Estado inicial
    }

    public function create(string $nombre, float $preciocompra, string $tipoproducto): void
    {
        $preciodeventa = $this->calcularPrecioVenta($preciocompra, $tipoproducto);
        $this->dProducto->create($nombre, $preciocompra, $preciodeventa, $tipoproducto);
        $this->setEstado(new EstadoRegistrado($this));
    }

    public function update(int $codigo, string $nombre, float $preciocompra, string $tipoproducto): void
    {
        if ($this->estado->puedeActualizar()) {
            $estado = $this->estado->getEstado(); // Obtener el estado actualizado
            $preciodeventa = $this->calcularPrecioVenta($preciocompra, $tipoproducto);
            $this->dProducto->update($codigo, $nombre, $preciocompra, $preciodeventa, $tipoproducto, $estado);
        } else {
            throw new Exception("No se puede actualizar el producto en el estado actual.");
        }
    }

    public function delete(int $codigo): void
    {
        $this->dProducto->delete($codigo);
    }

    public function getAll(): array
    {
        return $this->dProducto->findAll();
    }

    public function findById(int $codigo)
    {
        return $this->dProducto->findById($codigo);
    }

    public function revisarProducto(): void
    {
        $this->estado->revisar();
    }

    public function guardarProducto(): void
    {
        $this->estado->guardar();
    }

    public function setEstado(Estado $estado): void
    {
        $this->estado = $estado;
    }

    private function calcularPrecioVenta(float $preciocompra, string $tipoproducto): float
    {
        switch ($tipoproducto) {
            case 'bebida':
                $calculo = new CalculoPrecioVentaBebida();
                break;
            case 'abarrotes':
                $calculo = new CalculoPrecioVentaAbarrotes();
                break;
            default:
                throw new Exception("Tipo de producto desconocido.");
        }
        return $calculo->calcularPrecioVenta($preciocompra); // Usar el método de plantilla
    }
}
?>
