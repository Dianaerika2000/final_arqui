<?php
include dirname(__DIR__) . '/negocio/NProducto.php';

class PProducto
{
    private $nProducto;

    public function __construct()
    {
        $this->nProducto = new NProducto();
    }

    public function list()
    {
        return $this->nProducto->getAll();
    }

    public function onClickDelete($codigo)
    {
        $this->nProducto->delete($codigo);
    }

    public function create($nombre, $preciocompra, $tipoproducto)
    {
        $this->nProducto->create($nombre, $preciocompra, $tipoproducto);
    }

    public function update($codigo, $nombre, $preciocompra, $tipoproducto)
    {
        $this->nProducto->update($codigo, $nombre, $preciocompra, $tipoproducto);
    }

    public function findById($codigo)
    {
        return $this->nProducto->findById($codigo);
    }
}

$pProducto = new PProducto();
$productos = $pProducto->list();

$editMode = false;
$editProducto = null;

if (isset($_POST['delete_button']) && isset($_POST['delete_codigo'])) {
    $codigoToDelete = $_POST['delete_codigo'];
    $pProducto->onClickDelete($codigoToDelete);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['create_button']) && isset($_POST['nombre']) && isset($_POST['preciocompra']) && isset($_POST['tipoproducto'])) {
    $nombre = $_POST['nombre'];
    $preciocompra = $_POST['preciocompra'];
    $tipoproducto = $_POST['tipoproducto'];
    $pProducto->create($nombre, $preciocompra, $tipoproducto);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['edit_button']) && isset($_POST['edit_codigo']) && isset($_POST['nombre']) && isset($_POST['preciocompra']) && isset($_POST['tipoproducto'])) {
    $codigoToEdit = $_POST['edit_codigo'];
    $nombre = $_POST['nombre'];
    $preciocompra = $_POST['preciocompra'];
    $tipoproducto = $_POST['tipoproducto'];
    $pProducto->update($codigoToEdit, $nombre, $preciocompra, $tipoproducto);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['edit_codigo'])) {
    $editMode = true;
    $editProducto = $pProducto->findById($_GET['edit_codigo']);
}
?>

<?php include(__DIR__ . './index.php'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="mt-5"><?php echo $editMode ? 'Editar Producto' : 'Crear Producto'; ?></h2>
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $editMode ? $editProducto->nombre : ''; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="preciocompra">Precio de Compra:</label>
                    <input type="number" id="preciocompra" name="preciocompra" class="form-control" value="<?php echo $editMode ? $editProducto->preciocompra : ''; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tipoproducto">Tipo de Producto:</label>
                    <select id="tipoproducto" name="tipoproducto" class="form-control" required>
                        <option value="bebida" <?php echo $editMode && $editProducto->tipoproducto == 'bebida' ? 'selected' : ''; ?>>Bebida</option>
                        <option value="abarrotes" <?php echo $editMode && $editProducto->tipoproducto == 'abarrotes' ? 'selected' : ''; ?>>Abarrotes</option>
                    </select>
                </div>
                <?php if ($editMode): ?>
                    <input type="hidden" name="edit_codigo" value="<?php echo $editProducto->codigo; ?>">
                    <button type="submit" class="btn btn-primary" name="edit_button">Guardar Cambios</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="create_button">Crear</button>
                <?php endif; ?>
            </form>

            <h2 class="mt-5">Lista de Productos</h2>
            <table class="table table-bordered border-primary rounded">
                <thead class="table-primary border-primary">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio de Compra</th>
                        <th scope="col">Precio de Venta</th>
                        <th scope="col">Tipo de Producto</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tablaCuerpo">
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo $producto->nombre; ?></td>
                            <td><?php echo $producto->preciocompra; ?></td>
                            <td><?php echo $producto->preciodeventa; ?></td>
                            <td><?php echo $producto->tipoproducto; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="?edit_codigo=<?php echo $producto->codigo; ?>" type="button" class="btn btn-warning mx-2 rounded text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="post" action="">
                                        <input type="hidden" name="delete_codigo" value="<?php echo $producto->codigo; ?>">
                                        <button type="submit" class="btn btn-danger" name="delete_button">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
