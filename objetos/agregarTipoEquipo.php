<?php
    require_once("../conexion/conexion.php");
    require_once("../clases/TipoEquipo.php");

    $accion = $_POST["accion"] ?? "guardar";
    $id = $_POST["tipo_id"] ?? null;

    $tipo = new TipoEquipo();

    if ($accion == "guardar") {
        $tipo->setNombre($_POST["txt_nombre"]);
        $tipo->setConexion($conexion);

        if ($tipo->insertarDatos()) {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Tipo de Equipo agregado con éxito</p><a href="../tipo_equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Tipos de Equipos</a></div></body>';
        } else {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al agregar el tipo de equipo</p><a href="../tipo_equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Tipos de Equipos</a></div></body>';
        }
    } elseif ($accion == "actualizar") {
        $tipo->setTipoId($id);
        $tipo->setNombre($_POST["txt_nombre"]);
        $tipo->setConexion($conexion);

        if ($tipo->actualizarDatos()) {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Tipo de Equipo actualizado con éxito</p><a href="../tipo_equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Tipos de Equipos</a></div></body>';
        } else {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al actualizar el tipo de equipo</p><a href="../tipo_equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Tipos de Equipos</a></div></body>';
        }
    } elseif ($accion == "eliminar") {
        if ($id) {
            $tipo->setTipoId($id);
            $tipo->setConexion($conexion);

            if ($tipo->eliminarDatos()) {
                echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Tipo de Equipo eliminado con éxito</p><a href="../tipo_equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Tipos de Equipos</a></div></body>';
            } else {
                echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al tratar de eliminar el tipo de equipo</p><a href="../tipo_equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Tipos de Equipos</a></div></body>';
            }
        }
    }
?>
