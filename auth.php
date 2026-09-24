<?php

session_start();

function es_admin() {

    if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin") {
        return true;
    } else {
        header("Location: index.php?error=NO autorizado");
        exit();
    }
}

?>