<?php
session_start();

// Cek jika pengguna belum login, redirect ke index.php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simpan data CV ke session
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['ttl'] = $_POST['ttl'];
    $_SESSION['pendidikan'] = $_POST['pendidikan'];
    header("Location: cv.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CV</title>
    <!-- Tambahkan Tailwind CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Tambahkan Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-md transform transition-all duration-300 hover:scale-105">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Buat CV Anda</h1>
        <form method="POST" action="" class="space-y-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Masukkan nama lengkap"
                    >
                </div>
            </div>
            <div>
                <label for="ttl" class="block text-sm font-medium text-gray-700">Tempat, Tanggal Lahir:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar-alt text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        id="ttl"
                        name="ttl"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: Jakarta, 1 Januari 1990"
                    >
                </div>
            </div>
            <div>
                <label for="pendidikan" class="block text-sm font-medium text-gray-700">Riwayat Pendidikan:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                        <i class="fas fa-graduation-cap text-gray-400"></i>
                    </div>
                    <textarea
                        id="pendidikan"
                        name="pendidikan"
                        rows="4"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: S1 Teknik Informatika, Universitas Contoh"
                    ></textarea>
                </div>
            </div>
            <div>
                <button
                    type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 hover:shadow-lg"
                >
                    Buat CV
                </button>
            </div>
        </form>
        <!-- Tombol Logout -->
        <div class="mt-6 text-center">
            <a href="logout.php" class="text-sm text-indigo-600 hover:text-indigo-500">Logout</a>
        </div>
    </div>
</body>
</html>