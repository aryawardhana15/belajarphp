<?php
session_start();

// Cek jika pengguna belum login, redirect ke index.php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Ambil data dari session
$email = $_SESSION['email'];
$nama = $_SESSION['nama'] ?? 'Belum diisi';
$ttl = $_SESSION['ttl'] ?? 'Belum diisi';
$pendidikan = $_SESSION['pendidikan'] ?? 'Belum diisi';
$pengalaman = $_SESSION['pengalaman'] ?? 'Belum diisi';
$hard_skill = $_SESSION['hard_skill'] ?? 'Belum diisi';
$soft_skill = $_SESSION['soft_skill'] ?? 'Belum diisi';
$prestasi = $_SESSION['prestasi'] ?? 'Belum diisi';
$foto = $_SESSION['foto'] ?? 'default.jpg'; // Jika tidak ada foto, gunakan default
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Anda</title>
    <!-- Tambahkan Tailwind CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Tambahkan Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-purple-50 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-4xl">
        <!-- Header dengan Foto Profil -->
        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6 mb-8">
            <img src="uploads/<?php echo htmlspecialchars($foto); ?>" alt="Foto Profil" class="w-32 h-32 rounded-full object-cover border-4 border-indigo-100">
            <div class="text-center md:text-left">
                <h1 class="text-4xl font-bold text-gray-800"><?php echo htmlspecialchars($nama); ?></h1>
                <p class="text-gray-600 mt-2"><?php echo htmlspecialchars($email); ?></p>
                <p class="text-gray-600"><?php echo htmlspecialchars($ttl); ?></p>
            </div>
        </div>

        <!-- Grid Layout untuk Konten CV -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Kiri -->
            <div class="space-y-8">
                <!-- Riwayat Pendidikan -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-indigo-600 p-2 rounded-full mr-3">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </span>
                        Riwayat Pendidikan
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <pre class="text-gray-800 whitespace-pre-wrap"><?php echo htmlspecialchars($pendidikan); ?></pre>
                    </div>
                </div>

                <!-- Pengalaman Kerja -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-indigo-600 p-2 rounded-full mr-3">
                            <i class="fas fa-briefcase text-white"></i>
                        </span>
                        Pengalaman Kerja
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <pre class="text-gray-800 whitespace-pre-wrap"><?php echo htmlspecialchars($pengalaman); ?></pre>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="space-y-8">
                <!-- Hard Skill -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-indigo-600 p-2 rounded-full mr-3">
                            <i class="fas fa-tools text-white"></i>
                        </span>
                        Hard Skill
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <pre class="text-gray-800 whitespace-pre-wrap"><?php echo htmlspecialchars($hard_skill); ?></pre>
                    </div>
                </div>

                <!-- Soft Skill -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-indigo-600 p-2 rounded-full mr-3">
                            <i class="fas fa-comments text-white"></i>
                        </span>
                        Soft Skill
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <pre class="text-gray-800 whitespace-pre-wrap"><?php echo htmlspecialchars($soft_skill); ?></pre>
                    </div>
                </div>

                <!-- Prestasi -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-indigo-600 p-2 rounded-full mr-3">
                            <i class="fas fa-trophy text-white"></i>
                        </span>
                        Prestasi
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <pre class="text-gray-800 whitespace-pre-wrap"><?php echo htmlspecialchars($prestasi); ?></pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Edit dan Logout -->
        <div class="mt-8 flex justify-center space-x-4">
            <a href="form.php" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300 flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit CV
            </a>
            <a href="logout.php" class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-300 flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>
    </div>

    <!-- Tambahkan Font Awesome untuk ikon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>