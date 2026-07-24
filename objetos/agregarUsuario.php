<?php
    require_once("../conexion/conexion.php");
    require_once("../clases/Usuarios.php");

    $usuarios = new Usuario;
    $usuarios->setUsuarioId($_POST["idUser"]);
    $usuarios->setUsuario($_POST["txt_userName"]);
    $usuarios->setEmail($_POST["txt_email"]);
    $usuarios->setContrasenia($_POST["txt_contrasenia"]);
    $usuarios->setRol($_POST["lst_rol"]);
    $usuarios->setConexion($conexion);
    if($usuarios->insertarUsuario()){
        echo'<p>
            usuario agregado con exito
        </p>';
    } else{
        echo '<p>
                No se pudo agregar con exito
            </p>';
    }
?>