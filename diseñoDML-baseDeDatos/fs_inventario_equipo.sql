CREATE DATABASE if NOT EXISTS fs_inventario_equipo;
USE fs_inventario_equipo;

CREATE TABLE marcas(
	marca_id INT AUTO_INCREMENT PRIMARY KEY,
	marca VARCHAR(50)
);

CREATE TABLE tipo_quipos(
	tipo_id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50)
);

CREATE TABLE puestos(
	puesto_id INT AUTO_INCREMENT PRIMARY KEY,
	puesto VARCHAR(100)
);

CREATE TABLE roles(
	rol_id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50),
	descripcion VARCHAR(255)
);

CREATE TABLE empleados(
	empleado_id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(100),
	apellido VARCHAR(100),
	telefono VARCHAR(20),
	puesto_id INT,
	fecha_nacimiento DATE
);

CREATE TABLE usuarios(
	usuario_id INT  PRIMARY KEY,
	usuario VARCHAR(50) NOT NULL,
	email VARCHAR(255) NOT NULL,
	contrasenia VARCHAR(255) NOT NULL,
	estado TINYINT,
	rol_id INT
);


CREATE TABLE equipos(
	equipo_id INT AUTO_INCREMENT PRIMARY KEY,
	no_serie VARCHAR(100),
	marca_id INT,
	descripcion TEXT,
	fecha_compra DATE NOT NULL,
	precio DECIMAL(10,2) NOT NULL,
	tipo_equipo INT,
	empleado_id INT
);
DROP TABLE equipos;

ALTER TABLE equipos
	ADD CONSTRAINT FOREIGN KEY (marca_id)
		REFERENCES marcas(marca_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY(tipo_equipo)
		REFERENCES tipo_quipos(tipo_id)
		ON UPDATE CASCADE 
		ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY(empleado_id)
		REFERENCES empleados(empleado_id)
		ON UPDATE CASCADE 
		ON DELETE CASCADE;
ALTER TABLE empleados
	ADD CONSTRAINT FOREIGN KEY(puesto_id)
		REFERENCES puestos(puesto_id)
		ON UPDATE CASCADE 
		ON DELETE CASCADE;

ALTER TABLE usuarios
	ADD CONSTRAINT FOREIGN KEY(usuario_id)
		REFERENCES empleados(empleado_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY(rol_id)
		REFERENCES roles(rol_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE;
		
SELECT empleados.empleado_id, CONCAT(empleados.nombre," ",empleados.apellido) AS nombre, empleados.telefono , puestos.puesto AS Puesto,
		 empleados.fecha_nacimiento FROM empleados 
INNER JOIN puestos
ON puestos.puesto_id = empleados.puesto_id
ORDER BY empleados.empleado_id ASC;

SELECT * FROM puestos;

SELECT * FROM roles;

SELECT usuarios.usuario_id, usuarios.usuario, usuarios.email, usuarios.estado, roles.nombre AS rol FROM usuarios
INNER JOIN roles 
ON roles.rol_id = usuarios.rol_id 
ORDER BY usuarios.usuario_id ASC;

SELECT empleados.empleado_id,
   CONCAT(empleados.nombre, ' ', empleados.apellido) AS nombre
   FROM empleados
   LEFT JOIN usuarios
   ON usuarios.usuario_id = empleados.empleado_id
   WHERE usuarios.usuario_id IS NULL
   ORDER BY empleados.nombre ASC;
   
SELECT equipos.equipo_id, equipos.no_serie, marcas.marca, 
			equipos.descripcion, equipos.fecha_compra, 
			equipos.precio, tipo_quipos.nombre,
			empleados.nombre
FROM 
	equipos
INNER JOIN marcas
ON marcas.marca_id = equipos.marca_id
INNER JOIN tipo_quipos
ON tipo_quipos.tipo_id = equipos.tipo_equipo
INNER JOIN empleados
ON empleados.empleado_id = equipos.empleado_id
ORDER BY equipos.equipo_id ASC;