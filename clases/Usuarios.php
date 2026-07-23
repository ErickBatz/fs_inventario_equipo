<?php
    class Usuario{
        //atributos 
        private $empleadoId;
        private $nombre;
        private $apellido;
        private $telefono;
        private $puesto_id;
        private $fecha_nacimiento;
        private $conexion;
        //metodos
        public static function obtnerRegistros($db){
            try {
                $sql = "SELECT * FROM usuarios";
                $statement = $db->prepare($sql);//consulta preparada 
                $statement->execute();//consulta ejecutada

                //obtener el resultado de la consulta y gurdarla en un array para recibirla en la vista
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error en obtener Usuarios".$e->getMessage();
            }

        }

        public function insertarUsuario(){
            $sql ="";
        }
    }

?>