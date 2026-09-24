<?php

session_start();

require "conexion.php";

$resultado = $conexion->query("SELECT * FROM productos");

$res = $_GET["res"] ?? "";
$error = $_GET["error"] ?? "";

?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="tarea.css">
   <title></title>

</head>

<body>
    
    <h1>TIENDA DE PRODUCTOS</h1>
    <a href="logout.php">Cerrar sesion</a>

    <?php if ($res == "ok"): ?>
       <p class="res">El producto se actualizo correctamente</p>
   <?php endif; ?>

    <?php if ($error != ""): ?>
       <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <main>
        <form class="buscador">
            <input
                type="text"
                id="buscar"
                placeholder="Buscar producto..."
                autocomplete="off"
            >
         </form>

        <section class="productos">
            <?php foreach ($resultado as $producto): ?>
                <article
                    class="producto"
                    data-nombre="<?= htmlspecialchars(strtolower($producto["nombre"])); ?>" >
                    <p>ID: <?= $producto["id"]; ?></p>
                    <h3>
                        <?= htmlspecialchars($producto["nombre"]); ?>
                    </h3>
                     <p>
                        Stock disponible:
                        <?= $producto["stock"]; ?>
                    </p>
                    <p>
                        $<?= $producto["precio"]; ?>
                    </p>


                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>

                        <a href="editar.php?id=<?= $producto["id"]; ?>">
                            Editar
                        </a>

                        <a href="eliminar.php?id=<?= $producto["id"]; ?>">
                            Eliminar
                        </a>

                    <?php endif; ?>

                </article>

            <?php endforeach; ?>

        </section>


        <!-- AGREGAR PRODUCTO -->

        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>

            <section class="agregar">

                <form class="form" action="guardar.php" method="POST">

                    <label for="nombre">Nombre</label>

                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        required
                    >


                    <label for="stock">Stock</label>

                    <input
                        type="number"
                        name="stock"
                        id="stock"
                        required
                    >


                    <label for="precio">Precio</label>

                    <input
                        type="number"
                        name="precio"
                        id="precio"
                        step="0.01"
                        required
                    >


                    <button class="btn-submit" type="submit">
                        Agregar producto
                    </button>

                </form>

            </section>

        <?php endif; ?>

    </main>


    <script>

        const buscar = document.getElementById("buscar");

        const productos = document.querySelectorAll(".producto");

        buscar.addEventListener("input", function() {

            const texto = buscar.value.toLowerCase();

            productos.forEach(function(producto) {

                const nombre = producto.dataset.nombre;

                if (nombre.includes(texto)) {

                    producto.style.display = "block";

                } else {

                    producto.style.display = "none";

                }

            });

        });

    </script>

</body>

</html>