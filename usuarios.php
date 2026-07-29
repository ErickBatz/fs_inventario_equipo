<?php
//utilizar el archivo de conexion y la clase region 
   require_once("conexion/conexion.php");
require_once("clases/Usuarios.php");
    //crear un objeto que permita llamar al metodo obtenerRegistros
    $listaUsuario = Usuario::obtnerRegistros($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-10 px-4">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Control de Usuarios</h1>
                <p class="mt-2 text-lg text-gray-600">Gestiona los usuarios del sistema.</p>
            </div>
            <div class="flex gap-3">
                <a href="agregar/formUser.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                    Agregar usuario
                </a>
                <a href="index.html" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                    Volver al Panel
                </a>
            </div>
        </header>

        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario Id</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Fila de ejemplo 1 -->
                    <?php 
                        foreach($listaUsuario as $usuario){ 
                    ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo($usuario["usuario_id"]);?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo($usuario["usuario"]);?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo($usuario["email"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($usuario["estado"] == 1): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                            <?php else: ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo($usuario["rol"]); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <a href="actualizar/actualizarUsuario.php?id=<?php echo $usuario['usuario_id'];?>" class="rounded bg-amber-500 px-3 py-1 text-xs font-semibold text-white hover:bg-amber-600">
                                     Actualizar
                                </a>
                               <form action="objetos/agregarUsuario.php" method="POST" onsubmit="return confirm('¿Eliminar este usuario?');">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="usuario_id" value="<?php echo $usuario['usuario_id']; ?>">
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

