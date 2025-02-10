<?php
$name = "Muhammad Alhafiz Arya Wardhana";
$id = "245150407111038";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-500 to-cyan-500 text-white">

    <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl shadow-lg text-center">
        <h1 class="text-2xl font-semibold">Hello, <span class="text-yellow-300"><?= $name; ?></span>!</h1>
        <p class="mt-2 text-lg">NIM saya adalah <span class="font-bold text-yellow-300"><?= $id; ?></span></p>
    </div>

</body>
</html>
