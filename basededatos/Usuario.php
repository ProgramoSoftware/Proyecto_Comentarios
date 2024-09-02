<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = $conectar->real_escape_string($email);
    $password = $conectar->real_escape_string($password);

    $sql = "SELECT * FROM usuario WHERE CORREO = '$email' AND CONTR = '$password'";
    $result = mysqli_query($conectar, $sql);

    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);
        $_SESSION["APELLIDOS"] = $usuario["APELLIDOS"];
        $_SESSION["CORREO"] = $usuario["CORREO"];
        $_SESSION["ESTADO"] = $usuario["ESTADO"];
        $_SESSION["CEL"] = $usuario["CEL"];
        $_SESSION["DESCRIPCION"] = $usuario["DESCRIPCION"];
        $_SESSION["GENERO"] = $usuario["GENERO"];
        $_SESSION["USUARIO_ID"] = $usuario["USUARIO_ID"];
        $_SESSION["NOMBRES"] =$usuario["NOMBRES"];
        $_SESSION["CONTR"] = $password;
// Asegúrate de que este campo exista en tu base de datos
        echo"<script> 
            alert('Ingresando... <3');
        </script>";
        header("Location: ../coment/index.php");
    } else {
        echo"<script> 
            alert('Datos mal Ingresados');
        </script>";
        header("Location: ../vista/iniciosesion.html?error=Datos mal ingresados");
    }
}
?>
