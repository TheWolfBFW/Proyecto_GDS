
<?php
if (!isset($_GET["id"])) exit("No id provided");
include_once "header.php";
include_once "nav.php";
$id = $_GET["id"];
include_once "functions.php";
$alumno = getAlumnoById($id);
?>
<div class="row">
    <div class="col-12">
        <h1 class="text-center">Editar alumno</h1>
    </div>
    <div class="col-12">
        <form action="alum_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $alumno->id ?>">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input value="<?php echo $alumno->name ?>" name="name" placeholder="Nombre" type="text" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    Actualizar <i class="fa fa-check"></i>
                </button>
            </div>
        </form>
    </div>
</div>