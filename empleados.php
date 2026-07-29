<?php
    require_once("conexion/conexion.php");
    require_once("clases/Empleados.php");

    $empleadoList = Empleado::obtenerRegistros($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Empleados</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <main class="max-w-7xl mx-auto py-10 px-4">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Control de Empleados</h1>
                <p class="mt-2 text-lg text-gray-600">Gestiona los empleados del sistema.</p>
            </div>
            <div class="flex gap-3">
                <a href="agregar/formEmpleado.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                    Agregar empleado
                </a>
                <a href="index.html" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                    Volver al Panel
                </a>
            </div>
        </header>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puesto ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de nacimiento</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($empleadoList as $empleado): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($empleado["empleado_id"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($empleado["nombre"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($empleado["apellido"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($empleado["telefono"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($empleado["Puesto"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($empleado["fecha_nacimiento"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <!-- Enlace dinámico pasando el ID por GET -->
                                <!-- Opción A: Un enlace simple con HTML (La más sencilla) -->
                                <a href="actualizar/actualiza-Empleado.php?id=<?php echo $empleado['empleado_id']; ?>" 
                                class="rounded bg-amber-500 px-3 py-1 text-xs font-semibold text-white">
                                Actualizar
                                </a>
                                <!-- Eliminar pasando ID y accion por la URL -->
                                <form action="objetos/agregarEmpleado.php" method="POST" onsubmit="return confirm('¿Eliminar este empleado?');">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="empleado_id" value="<?php echo $empleado['empleado_id']; ?>">
                                    <button type="submit" class="rounded bg-red-500 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
