<?php
include dirname(__DIR__) . '/negocio/NCategoria.php';

class PCategoria
{
    private $nCategoria;

    public function __construct()
    {
        $this->nCategoria = new NCategoria();
    }

    public function list()
    {
        return $this->nCategoria->getAll();
    }

    public function onClickDelete($id)
    {
        $this->nCategoria->delete($id);
    }

    public function create($descripcion)
    {
        $this->nCategoria->create($descripcion);
    }

    public function update($id, $descripcion)
    {
        $this->nCategoria->update($id, $descripcion);
    }

    public function findById($id)
    {
        return $this->nCategoria->findById($id);
    }
}

$pCategoria = new PCategoria();
$categorias = $pCategoria->list();

$editMode = false;
$editCategoria = null;

if (isset($_POST['delete_button']) && isset($_POST['delete_id'])) {
    $idToDelete = $_POST['delete_id'];
    $pCategoria->onClickDelete($idToDelete);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['create_button']) && isset($_POST['descripcion'])) {
    $descripcion = $_POST['descripcion'];
    $pCategoria->create($descripcion);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['edit_button']) && isset($_POST['edit_id']) && isset($_POST['descripcion'])) {
    $idToEdit = $_POST['edit_id'];
    $descripcion = $_POST['descripcion'];
    $pCategoria->update($idToEdit, $descripcion);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['edit_id'])) {
    $editMode = true;
    $editCategoria = $pCategoria->findById($_GET['edit_id']);
}
?>

<?php include(__DIR__ . './index.php'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="mt-5"><?php echo $editMode ? 'Editar Categoría' : 'Crear Categoría'; ?></h2>
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $editMode ? $editCategoria->descripcion : ''; ?>" required>
                </div>
                <?php if ($editMode): ?>
                    <input type="hidden" name="edit_id" value="<?php echo $editCategoria->id; ?>">
                    <button type="submit" class="btn btn-primary" name="edit_button">Guardar Cambios</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="create_button">Crear</button>
                <?php endif; ?>
            </form>

            <h2 class="mt-5">Lista de Categorías</h2>
            <table class="table table-bordered border-primary rounded">
                <thead class="table-primary border-primary">
                    <tr>
                        <th scope="col">Descripción</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tablaCuerpo">
                    <?php foreach ($categorias as $categoria) : ?>
                        <tr>
                            <td><?php echo $categoria->descripcion; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="?edit_id=<?php echo $categoria->id; ?>" type="button" class="btn btn-warning mx-2 rounded text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="post" action="">
                                        <input type="hidden" name="delete_id" value="<?php echo $categoria->id; ?>">
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
