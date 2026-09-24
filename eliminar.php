<?php

require "conexion.php";
require "auth.php";

es_admin();

$id = $_GET["id"] ?? null;

if ($id) {
    $consulta = $conexion->prepare("DELETE FROM productos WHERE id = :id");

    $resultado = $consulta->execute([
     ':id' => $id
    ]);


    if ($resultado) {
       header("location: index.php?res=ok");

    }
}

?>