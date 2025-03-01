<?php
$name = "welcome to website belajar arya";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gradient-to-r from-blue-500 to-cyan-500 text-white">
    <?php include "layout/header.html"; ?>



    <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl shadow-lg text-center">
        <h1 class="text-2xl font-semibold">Hai, <span class="text-yellow-300"><?= $name; ?></span>!</h1>
    </div>

<?php include "layout/footer.html"; ?>

</body>
</html>
