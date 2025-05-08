<!-- application/views/layouts/main.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'App' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <aside class="w-64 bg-white shadow-md p-4">
            <h1 class="text-2xl font-bold mb-4">App Menu</h1>
            <ul class="pl-5 mt-10 space-y-4 text-gray-500">
                <li><a href="/">Patients</a></li>
                <li><a href="/doctors">Doctors</a></li>
            </ul>
        </aside>

        <main class="flex-1 overflow-y-auto p-6 bg-slite-50">
            <?= $this->include($content) ?>
        </main>
    </div>

</body>

</html>
