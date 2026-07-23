<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <main class="mx-auto max-w-3xl px-4 py-10">
        <header class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Agregar usuario</h1>
                <p class="mt-2 text-lg text-gray-600">Completa los campos para registrar un nuevo usuario.</p>
            </div>
            <a href="usuarios.php" class="rounded-lg bg-blue-500 px-4 py-2 font-bold text-white transition-all duration-300 hover:bg-blue-700">
                Volver a usuarios
            </a>
        </header>

        <section class="rounded-xl bg-white p-6 shadow-md sm:p-8">
            <form action="" method="post" class="space-y-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="num_userID" class="mb-2 block text-sm font-medium text-gray-700">ID de usuario</label>
                        <input type="number" id="num_userID" name="num_userID" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="txt_userName" class="mb-2 block text-sm font-medium text-gray-700">Nombre de usuario</label>
                        <input type="text" id="txt_userName" name="txt_userName" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="txt_email" class="mb-2 block text-sm font-medium text-gray-700">Correo electrónico</label>
                        <input type="email" id="txt_email" name="txt_email" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="txt_contrasenia" class="mb-2 block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="txt_contrasenia" id="txt_contrasenia" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="num_estado" class="mb-2 block text-sm font-medium text-gray-700">Estado</label>
                        <input type="number" name="num_estado" id="num_estado" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="num_rolID" class="mb-2 block text-sm font-medium text-gray-700">ID de rol</label>
                        <input type="number" name="num_rolID" id="num_rolID" required class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                    <a href="usuarios.php" class="rounded-lg bg-gray-200 px-4 py-2 font-bold text-gray-700 transition-all duration-300 hover:bg-gray-300">Cancelar</a>
                    <button type="submit" class="rounded-lg bg-green-500 px-4 py-2 font-bold text-white transition-all duration-300 hover:bg-green-700">Guardar usuario</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
