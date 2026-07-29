<?php
    require_once("../conexion/conexion.php");
    require_once("../clases/Marcas.php");

    $accion = $_POST["accion"] ?? "guardar";
    $id = $_POST["marca_id"] ?? null;

    $marca = new Marcas();

    if ($accion == "guardar") {
        $marca->setMarca($_POST["txt_marca"]);
        $marca->setConexion($conexion);

        if ($marca->insertarDatos()) {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Marca agregada con éxito</p><a href="../marcas.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Marcas</a></div></body>';
        } else {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al agregar la marca</p><a href="../marcas.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Marcas</a></div></body>';
        }
    } elseif ($accion == "actualizar") {
        $marca->setMarcaId($id);
        $marca->setMarca($_POST["txt_marca"]);
        $marca->setConexion($conexion);

        if ($marca->actualizarDatos()) {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Marca actualizada con éxito</p><a href="../marcas.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Marcas</a></div></body>';
        } else {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al actualizar la marca</p><a href="../marcas.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Marcas</a></div></body>';
        }
    } elseif ($accion == "eliminar") {
        if ($id) {
            $marca->setMarcaId($id);
            $marca->setConexion($conexion);

            if ($marca->eliminarDatos()) {
                echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Marca eliminada con éxito</p><a href="../marcas.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Marcas</a></div></body>';
            } else {
                echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al tratar de eliminar la marca</p><a href="../marcas.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Marcas</a></div></body>';
            }
        }
    }
?>
