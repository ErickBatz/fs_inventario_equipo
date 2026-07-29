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
        public function setEmpleadoID($empleadoId){
            $this->empleadoId = $empleadoId;
        }
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
                $sql ='SELECT empleados.empleado_id,CONCAT (empleados.nombre, " ", empleados.apellido) AS nombreCompleto,empleados.nombre,  empleados.apellido, empleados.      telefono , puestos.puesto AS Puesto,
                            empleados.fecha_nacimiento FROM empleados 
                    INNER JOIN puestos
                    ON puestos.puesto_id = empleados.puesto_id
                    ORDER BY empleados.empleado_id ASC;';
                $stmt = $db->prepare($sql);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo("Error en la ejecucion").$e->getMessage();
            }

        }

        public static function obtenerEmpleadosSinUsuario($db){
            
            try{
                $sql = 'SELECT empleados.empleado_id,
                        CONCAT(empleados.nombre, " ", empleados.apellido) AS nombre
                        FROM empleados
                        LEFT JOIN usuarios
                        ON usuarios.usuario_id = empleados.empleado_id
                        WHERE usuarios.usuario_id IS NULL
                        ORDER BY empleados.nombre ASC';
                $stmt= $db->prepare($sql);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            }  catch(PDOException $e){
                    return[];
            }

        }


        public function insertarDatos(){
            $sql="INSERT INTO empleados (nombre, apellido, telefono, puesto_id, fecha_nacimiento) 
                VALUES (:nombre,:apellido,:telefono,:puestoId,:fechaNacimiento)";
            $stmt = $this->conexion->prepare($sql);
            //vincular los parametros o valores que se necesitan almacenar con (variables de la consulta preparada 
            //(:nombres,:apellido,:telefono,:puestoId,:fechaNacimiento)
             $stmt->bindParam(':nombre' ,$this->nombre);
             $stmt->bindParam(':apellido',$this->apellido);
             $stmt->bindParam(':telefono',$this->telefono);
             $stmt->bindParam(':puestoId',$this->puestoId);
             $stmt->bindParam(':fechaNacimiento',$this->fechaNacimiento);

             return $stmt->execute();
        }

        public function actualizarDatos() {
          
          $sql = "UPDATE empleados 
                    SET nombre = :nombre, 
                        apellido = :apellido, 
                        telefono = :telefono, 
                        puesto_id = :puestoId, 
                        fecha_nacimiento = :fechaNacimiento 
                    WHERE empleado_id = :id";

            $stmt = $this->conexion->prepare($sql);

            // Vinculamos los valores a actualizar desde las propiedades del objeto
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellido', $this->apellido);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':puestoId', $this->puestoId);
            $stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
            
            // Es indispensable vincular el ID del registro que se va a modificar
            $stmt->bindParam(':id', $this->empleadoId);
            return $stmt->execute();    
        }

             public function eliminarDatos() {
                $sql = "DELETE FROM empleados WHERE empleado_id = :id";
                
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $this->empleadoId);
                
                return $stmt->execute();
        }
    }

?>