<?php
    class TipoEquipo{
        //atributos
        private $tipo_id;
        private $nombre;
        private $conexion;

        //metodos
        public function setTipoId($tipo_id){
            $this->tipo_id = $tipo_id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setConexion($conexion){
            $this->conexion = $conexion;
        }
       
        public static function obtenerTipos($db){
            try {
                $sql = 'SELECT * FROM tipo_quipos ORDER BY tipo_quipos.tipo_id ASC';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo("Error en la ejecución: ").$e->getMessage();
            }
        }

        public static function obtenerTipoPorID($db, $id) {
            try {
                $sql = 'SELECT * FROM tipo_quipos WHERE tipo_id = ?';
                $stmt = $db->prepare($sql);
                $stmt->execute([$id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return null;
            }
        }

        public function insertarDatos(){
            $sql = "INSERT INTO tipo_quipos (nombre) VALUES (:nombre)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $this->nombre);
            return $stmt->execute();
        }

        public function actualizarDatos() {
            $sql = "UPDATE tipo_quipos SET nombre = :nombre WHERE tipo_id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':id', $this->tipo_id);
            return $stmt->execute();
        }

        public function eliminarDatos() {
            $sql = "DELETE FROM tipo_quipos WHERE tipo_id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $this->tipo_id);
            return $stmt->execute();
        }
    }
?>
