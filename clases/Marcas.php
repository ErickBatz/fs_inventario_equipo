<?php 
    class Marcas{
        //atributos
        private $marca_id;
        private $marca;
        private $conexion;

        //metodos
        public function setMarcaId($marca_id){
            $this->marca_id = $marca_id;
        }

        public function setMarca($marca){
            $this->marca = $marca;
        }

        public function setConexion($conexion){
            $this->conexion = $conexion;
        }
       
        public static function obtenerMarcas($db){
            try {
                $sql='SELECT * FROM marcas ORDER BY marcas.marca_id ASC';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo("Error en la ejecución: ").$e->getMessage();
            }
        }

        public static function obtenerMarcaPorID($db, $id) {
            try {
                $sql = 'SELECT * FROM marcas WHERE marca_id = ?';
                $stmt = $db->prepare($sql);
                $stmt->execute([$id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return null;
            }
        }

        public function insertarDatos(){
            $sql="INSERT INTO marcas (marca) VALUES (:marca)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':marca', $this->marca);
            return $stmt->execute();
        }

        public function actualizarDatos() {
            $sql = "UPDATE marcas SET marca = :marca WHERE marca_id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':marca', $this->marca);
            $stmt->bindParam(':id', $this->marca_id);
            return $stmt->execute();
        }

        public function eliminarDatos() {
            $sql = "DELETE FROM marcas WHERE marca_id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $this->marca_id);
            return $stmt->execute();
        }
    }
?>