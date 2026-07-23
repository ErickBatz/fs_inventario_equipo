<?php
    $host = "localhost";
    $base_datos = "fs_inventario_equipo";
    $usuario = "root";
    $contrasena = ""; //no tiene contraseña ya que no se ha configurado 

    try {
        $conexion = new PDO("mysql:host={$host}; dbname={$base_datos}; charset=UTF8", $usuario, $contrasena);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $th) {
        die("Error al conectar a la base de datos: " . $th );
    }


?>