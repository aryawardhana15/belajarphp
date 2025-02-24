<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <title>Dashboard arya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4 grid grid-cols-12 gap-6">
        <!-- Sidebar Section -->
        <aside class="col-span-2 bg-white shadow-lg rounded-lg h-screen fixed">
            <div class="p-6">
                <div class="flex items-center gap-2">
                    <img src="images/logo.png" alt="arya logo" class="w-8 h-8">
                    <h2 class="text-xl font-bold">Dashboard.<span class="text-red-500">Belajar</span></h2>
                </div>
                <div class="mt-6">
                    <a href="dashboard.html" class="flex items-center gap-2 p-2 text-blue-600 bg-blue-50 rounded-lg">
                        <span class="material-icons-sharp">dashboard</span>
                        <h3>Dashboard</h3>
                    </a>
                    <a href="books.php" class="flex items-center gap-2 p-2 text-gray-700 hover:text-blue-600">
                        <span class="material-icons-sharp">book</span>
                        <h3>Books</h3>
                    </a>
                    <a href="groups.php" class="flex items-center gap-2 p-2 text-gray-700 hover:text-blue-600">
                        <span class="material-icons-sharp">group</span>
                        <h3>Groups</h3>
                    </a>
                    <a href="events.php" class="flex items-center gap-2 p-2 text-gray-700 hover:text-blue-600">
                        <span class="material-icons-sharp">event</span>
                        <h3>Events</h3>
                    </a>
                    <a href="users.html" class="flex items-center gap-2 p-2 text-gray-700 hover:text-blue-600">
                        <span class="material-icons-sharp">person_outline</span>
                        <h3>Users</h3>
                    </a>
                    <a href="index.html" class="flex items-center gap-2 p-2 text-gray-700 hover:text-blue-600">
                        <span class="material-icons-sharp">settings</span>
                        <h3>Analytics</h3>
                    </a>
                    <a href="reports.html" class="flex items-center gap-2 p-2 text-gray-700 hover:text-blue-600">
                        <span class="material-icons-sharp">report_gmailerrorred</span>
                        <h3>Reports</h3>
                    </a>
                    <a href="settings.html" class="flex items-center gap-2 p-2 text-gray-700 hover:text-blue-600">
                        <span class="material-icons-sharp">settings</span>
                        <h3>Settings</h3>
                    </a>
                    <a href="#" class="flex items-center gap-2 p-2 text-gray-700 hover:text-blue-600">
                        <span class="material-icons-sharp">logout</span>
                        <h3>Logout</h3>
                    </a>
                </div>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main class="col-span-10 ml-64">
            <div class="p-6">
                <h1 class="text-2xl font-semibold text-blue-600">Welcome, <span id="username"></span>!</h1>
                <p class="mt-2 text-gray-700">We're so glad to have you here at Dashboard belajar arya.</p>
            </div>
            <div class="mt-8 p-6">
                <h2 class="text-xl font-semibold text-blue-600 mb-4">About arya</h2>
                <p class="text-gray-700 leading-relaxed">
                    Dashboard belajar arya adalah platform yang memudahkan Anda dalam mengelola dan mengelola buku, kelompok, acara, pengguna, dan laporan.
                </p>
            </div>
        </main>
    </div>
</body>

</html>