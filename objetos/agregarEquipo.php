<?php
    require_once("../conexion/conexion.php");
    require_once("../clases/Equipo.php");

    $accion = $_POST["accion"] ?? "guardar";
    $id = $_POST["equipo_id"] ?? null;

    $equipo = new Equipo();

    if ($accion == "guardar") {
        $equipo->setNoSerie($_POST["txt_noSerie"]);
        $equipo->setMarcaID($_POST["lst_marca"]);
        $equipo->setDescripcion($_POST["txt_descripcion"]);
        $equipo->setFechaCompra($_POST["date_fechaCompra"]);
        $equipo->setPrecio($_POST["txt_precio"]);
        $equipo->setTipoEquipo($_POST["lst_tipo"]);
        $equipo->setEmpleadoID($_POST["lst_empleado"]); // may be empty / null
        $equipo->setConexion($conexion);

        if ($equipo->insertarDatos()) {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Equipo agregado con éxito</p><a href="../equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Equipos</a></div></body>';
        } else {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al agregar el equipo</p><a href="../equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Equipos</a></div></body>';
        }
    } elseif ($accion == "actualizar") {
        $equipo->setEquipoID($id);
        $equipo->setNoSerie($_POST["txt_noSerie"]);
        $equipo->setMarcaID($_POST["lst_marca"]);
        $equipo->setDescripcion($_POST["txt_descripcion"]);
        $equipo->setFechaCompra($_POST["date_fechaCompra"]);
        $equipo->setPrecio($_POST["txt_precio"]);
        $equipo->setTipoEquipo($_POST["lst_tipo"]);
        $equipo->setEmpleadoID($_POST["lst_empleado"]); // may be empty / null
        $equipo->setConexion($conexion);

        if ($equipo->actualizarDatos()) {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Equipo actualizado con éxito</p><a href="../equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Equipos</a></div></body>';
        } else {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al actualizar el equipo</p><a href="../equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Equipos</a></div></body>';
        }
    } elseif ($accion == "eliminar") {
        if ($id) {
            $equipo->setEquipoID($id);
            $equipo->setConexion($conexion);

            if ($equipo->eliminarDatos()) {
                echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Equipo eliminado con éxito</p><a href="../equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Equipos</a></div></body>';
            } else {
                echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al tratar de eliminar el equipo</p><a href="../equipos.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Equipos</a></div></body>';
            }
        }
    }
?>
