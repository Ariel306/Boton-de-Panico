<?php
    include '../conexion/config.php';

    $correo = $_POST['email'];
    $contrasena = $_POST['password'];

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' and contrasena='$contrasena'");

    if(mysqli_num_rows($validar_login) > 0){
        header("location: ../index.php");
        exit;
    }else{
        echo '
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                windows.location = "../index.php";
            </script>
        ';
        exit;
    }
?>