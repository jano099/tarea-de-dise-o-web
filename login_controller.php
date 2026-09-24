<?php

require "conexion.php";

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username) || empty($password)) {
    die("Todos los campos deben ser completados");
}

$consulta = $conexion->prepare(
    "SELECT usuario, contrasena, rol FROM usuario WHERE usuario = :usuario"
);

$consulta->execute([
    ':usuario' => $username
]);

$usuario = $consulta->fetch();

if($usuario && $password == $usuario['contrasena']) {

    session_start();

    $_SESSION['usuario'] = $usuario['usuario'];
    $_SESSION['rol'] = $usuario['rol'];

    header("location: index.php");

} else {
    die("Usuario o contraseña incorrectos");
}

?>