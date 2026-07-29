<?php
    require_once("../conexion/conexion.php");
    require_once("../clases/Usuarios.php");

    $accion = $_POST["accion"] ?? "guardar";
    $id = $_POST["usuario_id"] ?? $_POST["idUser"] ?? null;

    $usuario = new Usuario();

    if ($accion == "guardar") {
        $usuario->setUsuarioId($_POST["idUser"]);
        $usuario->setUsuario($_POST["txt_userName"]);
        $usuario->setEmail($_POST["txt_email"]);
        $usuario->setContrasenia($_POST["txt_contrasenia"]);
        $usuario->setRol($_POST["lst_rol"]);
        $usuario->setConexion($conexion);

        if ($usuario->insertarUsuario()) {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Usuario agregado con éxito</p><a href="../usuarios.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Usuarios</a></div></body>';
        } else {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">No se pudo agregar con éxito</p><a href="../usuarios.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Usuarios</a></div></body>';
        }
    } elseif ($accion == "actualizar") {
        $existente = Usuario::obtenerUsuariosPorID($conexion, $id);
        $password = $existente['contrasenia'] ?? '';

        $usuario->setUsuarioId($id);
        $usuario->setUsuario($_POST["txt_userName"]);
        $usuario->setEmail($_POST["txt_email"]);
        $usuario->setContrasenia($password);
        $usuario->setEstado($_POST["estado"]);
        $usuario->setRol($_POST["lst_rol"]);
        $usuario->setConexion($conexion);

        if ($usuario->actualizarDatos()) {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Usuario actualizado con éxito</p><a href="../usuarios.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Usuarios</a></div></body>';
        } else {
            echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al actualizar el usuario</p><a href="../usuarios.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Usuarios</a></div></body>';
        }
    } elseif ($accion == "eliminar") {
        if ($id) {
            $usuario->setUsuarioId($id);
            $usuario->setConexion($conexion);

            if ($usuario->eliminarDatos()) {
                echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-green-600 text-lg font-semibold mb-4">Usuario eliminado con éxito</p><a href="../usuarios.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Usuarios</a></div></body>';
            } else {
                echo '<body class="bg-gray-100 font-sans flex items-center justify-center h-screen"><div class="bg-white p-8 rounded-lg shadow-md text-center"><p class="text-red-600 text-lg font-semibold mb-4">Error al tratar de eliminar al usuario</p><a href="../usuarios.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-300">Volver a Usuarios</a></div></body>';
            }
        }
    }
?>