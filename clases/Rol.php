<?php
    class Rol{
        //atributos

        //metodos 

        public static function obtenerRol($db){
            try {

                $sql = "SELECT * FROM roles";
                $stmt =$db->prepare($sql);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo("error en conexion").$e->getMessage();
            }
        
        }
    }

?>