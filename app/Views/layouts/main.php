<!-- application/views/layouts/main.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'App' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="p-10 h-screen bg-gradient-to-tr from-blue-50 to-sky-50">

    <div class="flex border-4 border-white rounded-2xl shadow-xl bg-gray-50 overflow-hidden">
        <div class="w-64 p-4 flex flex-col justify-between bg-white shadow-md">
            <div>
                <h1 class="text-2xl font-bold mb-4">App Menu</h1>
                <div class="pl-5 mt-10 flex flex-col justify-between space-y-4 text-gray-500">
                    <a href="/">Patients</a>
                    <a href="/doctors">Doctors</a>
                </div>
            </div>
            <div class="pl-5 flex flex-col gap-5">
                <a href="/logout" class="text-red-500">Logout</a>
                <a href="/deleteUser" class="text-red-500">Delete your account</a>
            </div>
        </div>

        <main class="flex-1 p-6 bg-slite-50 overflow-hidden">
            <?= $this->include($content) ?>
        </main>
    </div>

</body>

</html>