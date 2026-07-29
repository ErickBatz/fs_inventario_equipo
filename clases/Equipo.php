<?php 
    class Equipo{
        //atributos
        private $equipo_id;
        private $noSerie;
        private $marca_id;
        private $descripcion;
        private $fecha_compra;
        private $precio;
        private $tipo_equipo;
        private $empleado_id;
        private $conexion;

        //metodos
        public function setEquipoID($equipo_id){
            $this->equipo_id = $equipo_id;
        }
        public function setNoSerie($noSerie){
            $this->noSerie = $noSerie;
        }
        public function setMarcaID($marca_id){
            $this->marca_id = $marca_id;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function setFechaCompra($fecha_compra){
            $this->fecha_compra = $fecha_compra;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }
        public function setTipoEquipo($tipo_equipo){
            $this->tipo_equipo = $tipo_equipo;
        }
        public function setEmpleadoID($empleado_id){
            $this->empleado_id = $empleado_id;
        }
        public function setConexion($conexion){
            $this->conexion = $conexion;
        }

        public static function obtenerEquipos($db){
            try {
                $sql = 'SELECT equipos.equipo_id, equipos.no_serie, marcas.marca, 
                               equipos.descripcion, equipos.fecha_compra, 
                               equipos.precio, tipo_quipos.nombre AS tipo,
                               CONCAT(empleados.nombre, " ", empleados.apellido) AS empleado
                        FROM equipos
                        INNER JOIN marcas ON marcas.marca_id = equipos.marca_id
                        INNER JOIN tipo_quipos ON tipo_quipos.tipo_id = equipos.tipo_equipo
                        LEFT JOIN empleados ON empleados.empleado_id = equipos.empleado_id
                        ORDER BY equipos.equipo_id ASC';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo("Error en la ejecución: ").$e->getMessage();
            }
        }

        public static function obtenerEquipoPorID($db, $id){
            try {
                $sql = 'SELECT * FROM equipos WHERE equipo_id = ?';
                $stmt = $db->prepare($sql);
                $stmt->execute([$id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return null;
            }
        }

        public function insertarDatos(){
            $sql = "INSERT INTO equipos (no_serie, marca_id, descripcion, fecha_compra, precio, tipo_equipo, empleado_id) 
                    VALUES (:no_serie, :marca_id, :descripcion, :fecha_compra, :precio, :tipo_equipo, :empleado_id)";
            $stmt = $this->conexion->prepare($sql);
            
            $stmt->bindParam(':no_serie', $this->noSerie);
            $stmt->bindParam(':marca_id', $this->marca_id);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':fecha_compra', $this->fecha_compra);
            $stmt->bindParam(':precio', $this->precio);
            $stmt->bindParam(':tipo_equipo', $this->tipo_equipo);
            
            // Si empleado_id es vacio, guardamos NULL
            if (empty($this->empleado_id)) {
                $null_val = null;
                $stmt->bindParam(':empleado_id', $null_val, PDO::PARAM_NULL);
            } else {
                $stmt->bindParam(':empleado_id', $this->empleado_id);
            }

            return $stmt->execute();
        }

        public function actualizarDatos() {
            $sql = "UPDATE equipos 
                    SET no_serie = :no_serie, 
                        marca_id = :marca_id, 
                        descripcion = :descripcion, 
                        fecha_compra = :fecha_compra, 
                        precio = :precio, 
                        tipo_equipo = :tipo_equipo, 
                        empleado_id = :empleado_id 
                    WHERE equipo_id = :id";
            $stmt = $this->conexion->prepare($sql);
            
            $stmt->bindParam(':no_serie', $this->noSerie);
            $stmt->bindParam(':marca_id', $this->marca_id);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':fecha_compra', $this->fecha_compra);
            $stmt->bindParam(':precio', $this->precio);
            $stmt->bindParam(':tipo_equipo', $this->tipo_equipo);
            $stmt->bindParam(':id', $this->equipo_id);

            if (empty($this->empleado_id)) {
                $null_val = null;
                $stmt->bindParam(':empleado_id', $null_val, PDO::PARAM_NULL);
            } else {
                $stmt->bindParam(':empleado_id', $this->empleado_id);
            }

            return $stmt->execute();
        }

        public function eliminarDatos() {
            $sql = "DELETE FROM equipos WHERE equipo_id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $this->equipo_id);
            return $stmt->execute();
        }
    }
?>