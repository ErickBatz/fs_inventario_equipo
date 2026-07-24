<?php
//establecer la conexion (requerir la conexion)
require_once("../conexion/conexion.php");
require_once("../clases/Empleados.php");
//crear un objeto (requrir la clase empleado)
$empleado = new Empleado();
//asignar los valores para los atributos del objeto
$empleado->setNombre($_POST["txt_empleadoName"]);
$empleado->setApellido($_POST["txt_apellido"]);
$empleado->setTelefono($_POST["txt_telefono"]);
$empleado->setPuestoId($_POST["lst_puesto"]);
$empleado->setFechaNacimiento($_POST["date_fechaNac"]);
$empleado->setConexion($conexion);

//llamar al metodo para agregar el empleado
if($empleado->insertarDatos()){
    echo '<p>
        se Agrego con exito el Empleado
    </p>';
} else{
    echo'
        <p>
            erro a la hora de agrega un nuevo empleado
        </p>
    ';
}

?>