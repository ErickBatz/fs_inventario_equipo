<?php
    require_once("conexion/conexion.php");
    require_once("clases/Marcas.php");

    $marcalist = Marcas::obtenerMarcas($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Marcas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <main class="max-w-7xl mx-auto py-10 px-4">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Control de Marcas</h1>
                <p class="mt-2 text-lg text-gray-600">Gestiona las Marcas del sistema.</p>
            </div>
            <div class="flex gap-3">
                <a href="agregar/formMarca.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                    Agregar Marca
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                        foreach($marcalist as $marca){


                        
                    ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo($marca["marca_id"]);?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo($marca["marca"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <a href="actualizar/actualizarMarca.php?id=<?php echo $marca['marca_id']; ?>" class="rounded bg-amber-500 px-3 py-1 text-xs font-semibold text-white hover:bg-amber-600">
                                    Actualizar
                                </a>
                                <form action="objetos/agregarMarca.php" method="POST" onsubmit="return confirm('¿Eliminar esta marca?');">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="marca_id" value="<?php echo $marca['marca_id']; ?>">
                                    <button type="submit" class="rounded bg-red-500 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>


