
<?php
if (!isset($_GET["id"])) {
    exit("No data provided");
}
include_once "functions.php";
$id = $_GET["id"];
deleteAlumno($id);
header("Location: alum.php");
