<?php
    require_once("../conexion/conexion.php");
    require_once("../clases/Marcas.php");
    require_once("../clases/TipoEquipo.php");
    require_once("../clases/Empleados.php");

    $lst_marcas = Marcas::obtenerMarcas($conexion);
    $lst_tipos = TipoEquipo::obtenerTipos($conexion);
    $lst_empleados = Empleado::obtenerRegistros($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Equipo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <main class="mx-auto max-w-3xl px-4 py-10">
        <header class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Agregar Equipo</h1>
                <p class="mt-2 text-lg text-gray-600">Completa los campos para registrar un nuevo equipo en el inventario.</p>
            </div>
            <a href="../equipos.php" class="rounded-lg bg-blue-500 px-4 py-2 font-bold text-white transition-all duration-300 hover:bg-blue-700">
                Volver a equipos
            </a>
        </header>

        <section class="rounded-xl bg-white p-6 shadow-md sm:p-8">
            <form action="../objetos/agregarEquipo.php" method="post" class="space-y-6">
                <input type="hidden" name="accion" value="guardar">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                   
                    <div>
                        <label for="txt_noSerie" class="mb-2 block text-sm font-medium text-gray-700">Número de Serie</label>
                        <input type="text" id="txt_noSerie" name="txt_noSerie" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="lst_marca" class="mb-2 block text-sm font-medium text-gray-700">Marca</label>
                        <div class="relative">
                            <select name="lst_marca" id="lst_marca" required class="block w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2.5 pr-10 text-gray-900 outline-none transition duration-200 hover:border-blue-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="" selected disabled>Selecciona una marca</option>
                            <?php foreach($lst_marcas as $marca): ?>
                                <option value="<?php echo($marca["marca_id"]) ?>"><?php echo($marca["marca"]) ?></option>
                            <?php endforeach; ?>
                            </select>
                            <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="txt_descripcion" class="mb-2 block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea id="txt_descripcion" name="txt_descripcion" rows="3" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></textarea>
                    </div>

                    <div>
                        <label for="date_fechaCompra" class="mb-2 block text-sm font-medium text-gray-700">Fecha de Compra</label>
                        <input type="date" name="date_fechaCompra" id="date_fechaCompra" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="txt_precio" class="mb-2 block text-sm font-medium text-gray-700">Precio</label>
                        <input type="number" step="0.01" name="txt_precio" id="txt_precio" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="lst_tipo" class="mb-2 block text-sm font-medium text-gray-700">Tipo de Equipo</label>
                        <div class="relative">
                            <select name="lst_tipo" id="lst_tipo" required class="block w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2.5 pr-10 text-gray-900 outline-none transition duration-200 hover:border-blue-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="" selected disabled>Selecciona un tipo</option>
                            <?php foreach($lst_tipos as $tipo): ?>
                                <option value="<?php echo($tipo["tipo_id"]) ?>"><?php echo($tipo["nombre"]) ?></option>
                            <?php endforeach; ?>
                            </select>
                            <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <label for="lst_empleado" class="mb-2 block text-sm font-medium text-gray-700">Empleado Asignado</label>
                        <div class="relative">
                            <select name="lst_empleado" id="lst_empleado" class="block w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2.5 pr-10 text-gray-900 outline-none transition duration-200 hover:border-blue-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="">No asignado</option>
                            <?php foreach($lst_empleados as $empleado): ?>
                                <option value="<?php echo($empleado["empleado_id"]) ?>"><?php echo($empleado["nombreCompleto"]) ?></option>
                            <?php endforeach; ?>
                            </select>
                            <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                    <a href="../equipos.php" class="rounded-lg bg-gray-200 px-4 py-2 font-bold text-gray-700 transition-all duration-300 hover:bg-gray-300">Cancelar</a>
                    <button type="submit" class="rounded-lg bg-green-500 px-4 py-2 font-bold text-white transition-all duration-300 hover:bg-green-700">Guardar Equipo</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
