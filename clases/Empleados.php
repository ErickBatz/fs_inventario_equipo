<?php
    class Empleado{
        //atributos
        private $empleadoId;
        private $nombre;
        private $apellido;
        private $telefono;
        private $puestoId;
        private $fechaNacimiento;
        private $conexion;

        //metodos
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setApellido($apellido){
            $this->apellido = $apellido;
        }
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }   
        public function setPuestoId($puestoID){
            $this->puestoId = $puestoID;
        }
        public function setFechaNacimiento($fechaNacimiento){
            $this->fechaNacimiento = $fechaNacimiento;
        }
        public function setConexion($conexion){
            $this->conexion = $conexion;
        }

        public static function obtenerRegistros($db){
            try {
                $sql ="SELECT * FROM empleados";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo("Error en la ejecucion").$e->getMessage();
            }

        }
        public function insertarDatos(){
            $sql="INSERT INTO empleados (nombre, apellido, telefono, puesto_id, fecha_nacimiento) 
                VALUES (:nombre,:apellido,:telefono,:puestoId,:fechaNacimiento)";
            $stmt = $this->conexion->prepare($sql);
            //vincular los parametros o valores que se necesitan almacenar con (variables de la consulta preparada 
            //(:nombres,:apellido,:telefono,:puestoId,:fechaNacimiento)
             $stmt->bindParam(':nombre,$this->nombre');
             $stmt->bindParam(':apellido,$this->apellido');
             $stmt->bindParam(':telefono,$this->telefono');
             $stmt->bindParam(':puestoId,$this->puestoId');
             $stmt->bindParam(':fechaNacimiento,$this->fechaNacimiento');

             return $stmt->execute();
        }
    }

?>