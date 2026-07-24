<?php
    class Puesto{
        //atributos 

        //metodos 
         public static function  obtenerPuestos($db){
            $sql = "SELECT * FROM puestos";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
    }

?>