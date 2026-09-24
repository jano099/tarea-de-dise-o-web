<?php

require "conexion.php";

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$rol = $_POST['rol'];

if(empty($usuario) || empty($contrasena) || empty($rol)) {
    die("Todos los campos deben ser completados");
}

$consulta = $conexion->prepare(
    "INSERT INTO usuario (usuario, contrasena, rol) VALUES (:usuario, :contrasena, :rol)"
);

$consulta->execute([
    ':usuario' => $usuario,
    ':contrasena' => $contrasena,
    ':rol' => $rol
]);

header("location: login.php");

?>