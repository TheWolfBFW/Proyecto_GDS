<?php
include_once "header.php";
include_once "nav2.php";
include_once "functions.php";
$alumnos = getAlumnos();
?>
<div class="row">
    <div class="col-12">
        <h1 class="text-center">Alumnos</h1>
    </div>
    <p  style="color: white" >

Sube un archivo:

<input type="file" name="archivosubido">

<input type="submit" value="Enviar datos">

</p>    
</div>