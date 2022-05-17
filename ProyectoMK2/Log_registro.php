<?php

include('conexion.php');

$email = $_POST["email"];
$contraseña = $_POST["contraseña"]; 
$rol = $_POST["rol"];

//login
if(isset ($_POST["entrar"]))
{
    $query = mysqli_query($conn,"SELECT * FROM registros WHERE Email ='$email' and Password = '$contraseña' and rol = '$rol'");
    $nr = mysqli_num_rows($query);  
    
if ($nr == 1 )  
    { 
        if($rol=="alumno")
            {   
                header("Location: employees.php");
            }
        else if ($rol=="maestro")
            {
                header("Location: attendance_register.php");
            }
    }
}


//registro

if(isset($_POST["registrar"]))
{
    $sqlgrabar = "INSERT INTO registros(Email,Password,rol) values ('$email','$contraseña','$rol')";

    
    if(mysqli_query($conn,$sqlgrabar))
    {
        echo "<script> alert('Usuario registrado con exito: $email '); window.location= 'index(Logueo).html'</script>";

    }
    
}
?>