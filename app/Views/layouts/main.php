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
        <?php include_sidebar(); ?>

        <main class="flex-1 p-6 bg-slite-50 overflow-hidden">
            <?= $this->include($content) ?>
        </main>
    </div>

</body>

</html>