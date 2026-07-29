<?php
require_once("../conexion/conexion.php");
require_once("../clases/Puesto.php");
require_once("../clases/Empleados.php");

// 1. Recibimos el ID por URL
$id = $_GET['id'] ?? null;

// 2. Traemos las listas simples
$lst_puesto = Puesto::obtenerPuestos($conexion);
$lst_empleado = Empleado::obtenerRegistros($conexion);

// 3. Buscamos el empleado seleccionado
$empleado_actual = null;
foreach($lst_empleado as $emp){
    if($emp["empleado_id"] == $id){}
    $empleado_actual = $emp;
    break;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Empleado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <main class="mx-auto max-w-3xl px-4 py-10">
        <header class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Actualizar Empleado</h1>
                <p class="mt-2 text-lg text-gray-600">Completa los campos para actualizar.</p>
            </div>
            <a href="../empleados.php" class="rounded-lg bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
                Volver a empleados
            </a>
        </header>

        <section class="rounded-xl bg-white p-6 shadow-md sm:p-8">
            <form action="../objetos/agregarEmpleado.php" method="POST" class="space-y-6">
                
                <!-- Campos ocultos -->
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="empleado_id" value="<?php echo $empleado_actual['empleado_id'] ?? ''; ?>">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    
                    <!-- Campo Nombre -->
                    <div>
                        <label for="txt_nombre" class="mb-2 block text-sm font-medium text-gray-700">Nombre de Empleado</label>
                        <input type="text" id="txt_nombre" name="txt_nombre" required 
                               value="<?php echo $empleado_actual['nombre'] ?? ''; ?>" 
                               class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <!-- Campo Apellido -->
                    <div>
                        <label for="txt_apellido" class="mb-2 block text-sm font-medium text-gray-700">Apellido de Empleado</label>
                        <input type="text" id="txt_apellido" name="txt_apellido" required 
                               value="<?php echo $empleado_actual['apellido'] ?? ''; ?>" 
                               class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <!-- Campo Teléfono -->
                    <div>
                        <label for="txt_telefono" class="mb-2 block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="txt_telefono" id="txt_telefono" required 
                               value="<?php echo $empleado_actual['telefono'] ?? ''; ?>" 
                               class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <!-- Select de Puesto -->
                   <div>
                                        <!-- Select de Puesto -->
                    <select name="lst_puesto" id="lst_puesto" class="...">
                        <option value="" disabled>Selecciona un puesto</option>

                        <?php foreach($lst_puesto as $puesto): ?>
                            <option value="<?php echo $puesto['puesto_id']; ?>" 
                                <?php if($puesto['puesto'] == $empleado_actual['Puesto']) { echo 'selected'; } ?>>
                                <?php echo $puesto['puesto']; ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                    </div>

                    <!-- Campo Fecha de Nacimiento -->
                    <div>
                        <label for="date_fechaNac" class="mb-2 block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" name="date_fechaNac" id="date_fechaNac" required 
                               value="<?php echo $empleado_actual['fecha_nacimiento'] ?? ''; ?>" 
                               class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                    <a href="../empleados.php" class="rounded-lg bg-gray-200 px-4 py-2 font-bold text-gray-700 hover:bg-gray-300">Cancelar</a>
                    <button type="submit" class="rounded-lg bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700">Actualizar Cambios</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>