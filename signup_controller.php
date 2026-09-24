<?php

require "conexion.php";

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

if(empty($usuario) || empty($contrasena)) {
    die("Todos los campos deben ser completados");
}

$consulta = $conexion->prepare(
    "INSERT INTO usuario (usuario, contrasena, rol) VALUES (:usuario, :contrasena, :rol)"
);

$consulta->execute([
    ':usuario' => $usuario,
    ':contrasena' => $contrasena,
    ':rol' => 'usuario'
]);

header("location: login.php");

?>