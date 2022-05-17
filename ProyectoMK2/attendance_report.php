
<?php
include_once "header.php";
include_once "nav2.php";
include_once "functions.php";
$start = date("Y-m-d");
$end = date("Y-m-d");
if (isset($_GET["start"])) {
    $start = $_GET["start"];
}
if (isset($_GET["end"])) {
    $end = $_GET["end"];
}
$alumnos = getAlumnosWithAttendanceCount($start, $end);
?>
<div class="row">
    <div class="col-12">
        <h1 class="text-center" style="color: white">Historial de asistencias</h1>
    </div>
    <div class="col-12">

        <form action="attendance_report.php" class="form-inline mb-2" style="color: white">
            <label for="start">Inicio:&nbsp;</label>
            <input required id="start" type="date" name="start" value="<?php echo $start ?>" class="form-control mr-2">
            <label for="end">Final:&nbsp;</label>
            <input required id="end" type="date" name="end" value="<?php echo $end ?>" class="form-control">
            <button class="btn btn-success ml-2">Filtro</button>
        </form>
    </div>
    <div class="col-12">
        <div class="table-responsive" >
            <table class="table">
                <thead style="color: white">
                    <tr>
                        <th>Alumno</th>
                        <td>Jesus Aljandro Zarazua Infante</td>
                        <th>Asistencias</th>
                        <td>20</td>
                        <th>Faltas</th>
                        <td>4</td>
                        <th>Ponderacion</th>
                        <td>87%</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno) { ?>
                        <tr>
                            <td>
                                <?php echo $alumno->name ?>
                            </td>
                            <td>
                                <?php echo $alumno->presence_count ?>
                            </td>
                            <td>
                                <?php echo $alumno->absence_count ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>