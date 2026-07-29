<?php
    class Usuario{
        //atributos 
        private $usuario_id;
        private $usuario;
        private $email;
        private $contrasenia;
        private $estado;
        private $rol;
        private $conexion;
        //metodos
        public function setUsuarioId($usuario_id){
            $this->usuario_id = $usuario_id;
        }


        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function setContrasenia($contrasenia){
            $this->contrasenia = $contrasenia;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
        public function setRol($rol){
            $this->rol = $rol;
        }
        public function setConexion($conexion){
            $this->conexion = $conexion;
        }

        public static function obtnerRegistros($db){
            try {
                $sql = "SELECT usuarios.usuario_id, usuarios.usuario, usuarios.email, usuarios.estado, roles.nombre AS rol FROM usuarios
                        INNER JOIN roles 
                        ON roles.rol_id = usuarios.rol_id 
                        ORDER BY usuarios.usuario_id ASC";
                $statement = $db->prepare($sql);//consulta preparada 
                $statement->execute();//consulta ejecutada

                //obtener el resultado de la consulta y gurdarla en un array para recibirla en la vista
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error en obtener Usuarios".$e->getMessage();
            }

        }
        public static function obtenerUsuariosPorID($conexion, $id){
            $sql ='SELECT * FROM usuarios WHERE usuario_id = ?';
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function insertarUsuario(){
           
           try {
                $sql ="INSERT INTO usuarios( usuario_id,usuario, email, contrasenia, estado, rol_id)
                        VALUES(:usuario_id,:usuario, :email, :contrasenia, 1, :rol)";
                $stmt = $this->conexion->prepare($sql);

                /*vincular los parametros o valores que se necesitan almacener con (variables de la consulta preparada )*/
                $stmt->bindParam(':usuario_id',$this->usuario_id);
                $stmt->bindParam(':usuario',$this->usuario);
                $stmt->bindParam(':email',$this->email);
                $stmt->bindParam(':contrasenia',$this->contrasenia);
                $stmt->bindParam(':rol',$this->rol);
                return $stmt->execute();
           } catch (\Throwable $th) {
                return 0;
           }
           

        }

        public function actualizarDatos() {
          
          $sql = "UPDATE usuarios 
                    SET usuario = :usuario, 
                        email = :email, 
                        contrasenia = :contrasenia, 
                        estado = :estado, 
                        rol_id = :rol 
                    WHERE usuario_id = :id";

            $stmt = $this->conexion->prepare($sql);

            // Vinculamos los valores a actualizar desde las propiedades del objeto
            $stmt->bindParam(':usuario', $this->usuario);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':contrasenia', $this->contrasenia);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':rol', $this->rol);
            
            // Es indispensable vincular el ID del registro que se va a modificar
            $stmt->bindParam(':id', $this->usuario_id);
            return $stmt->execute();    
        }

        public function eliminarDatos() {
            $sql = "DELETE FROM usuarios WHERE usuario_id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $this->usuario_id);
            return $stmt->execute();
        }
    }

?>