<?php
    // Establecer la conexión (requerir la conexión)
    require_once("../conexion/conexion.php");
    require_once("../clases/Empleados.php");

    $accion = $_POST["accion"] ?? "guardar";
    $id = $_POST["empleado_id"] ?? null;

    // Crear un objeto (requerir la clase empleado)
    $empleado = new Empleado();

    // EVALUAMOS LA ACCIÓN QUE VAMOS A REALIZAR
    if ($accion == "guardar") {
        
        // Asignamos datos solo para guardar
        $empleado->setNombre($_POST["txt_nombre"]);
        $empleado->setApellido($_POST["txt_apellido"]);
        $empleado->setTelefono($_POST["txt_telefono"]);
        $empleado->setPuestoId($_POST["lst_puesto"]);
        $empleado->setFechaNacimiento($_POST["date_fechaNac"]);
        $empleado->setConexion($conexion);

        // Ejecutamos la inserción
        if ($empleado->insertarDatos()) {
            echo '<p>Se agregó con éxito el Empleado</p>';
        } else {
            echo '<p>Error a la hora de agregar un nuevo empleado</p>';
        }

    } elseif ($accion == "actualizar") {

        // Asignamos datos e ID solo para actualizar
        $empleado->setEmpleadoID($id);
        $empleado->setNombre($_POST["txt_nombre"]);
        $empleado->setApellido($_POST["txt_apellido"]);
        $empleado->setTelefono($_POST["txt_telefono"]);
        $empleado->setPuestoId($_POST["lst_puesto"]);
        $empleado->setFechaNacimiento($_POST["date_fechaNac"]);
        $empleado->setConexion($conexion);

        if ($empleado->actualizarDatos()) {
            echo "<p>Se actualizó con éxito el empleado</p>";
        } else {
            echo "<p>Error al actualizar el empleado</p>";
        }

    } elseif ($accion == "eliminar") {

        // Para eliminar SOLO necesitamos el ID y la conexión
        if ($id) {
            $empleado->setEmpleadoID($id);
            $empleado->setConexion($conexion);

            if ($empleado->eliminarDatos()) {
                echo "<p>Se eliminó con éxito el empleado</p>";
            } else {
                echo "<p>Error al tratar de eliminar al empleado</p>";
            }
        }
    }
?>