<?php
session_start();

// Include file koneksi database
include 'database.php';

// Cek koneksi database
if ($conn) {
    echo "Koneksi ke database 'belajar' berhasil!";
} else {
    echo "Gagal terhubung ke database.";
}

// Inisialisasi variabel error
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi CSRF Token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }

    // Validasi Nama
    if (empty($_POST['name'])) {
        $errors['name'] = 'Nama lengkap harus diisi.';
    }

    // Validasi Email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Alamat email harus diisi.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid.';
    }

    // Validasi Password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password harus diisi.';
    } elseif (strlen($_POST['password']) < 6) {
        $errors['password'] = 'Password minimal 6 karakter.';
    }

    // Validasi Konfirmasi Password
    if ($_POST['password'] !== $_POST['confirm-password']) {
        $errors['confirm-password'] = 'Password tidak sama.';
    }

    // Validasi Gender
    if (empty($_POST['gender'])) {
        $errors['gender'] = 'Gender harus dipilih.';
    }

    // Validasi Terms and Conditions
    if (!isset($_POST['terms'])) {
        $errors['terms'] = 'Anda harus menyetujui terms and conditions.';
    }

    // Validasi Captcha
    $secretKey = "your_secret_key";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);
    if (!$response->success) {
        $errors['captcha'] = 'Captcha verification failed.';
    }

    // Jika tidak ada error, proses data
    if (empty($errors)) {
        // Escape input untuk menghindari SQL injection
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
        $gender = $conn->real_escape_string($_POST['gender']);

        // Handle upload foto profil
        if (isset($_FILES['profile-picture'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profile-picture"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Cek apakah file adalah gambar
            $check = getimagesize($_FILES["profile-picture"]["tmp_name"]);
            if ($check === false) {
                $errors['profile-picture'] = 'File bukan gambar.';
            }

            // Cek ukuran file
            if ($_FILES["profile-picture"]["size"] > 500000) {
                $errors['profile-picture'] = 'Ukuran file terlalu besar.';
            }

            // Cek format file
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $errors['profile-picture'] = 'Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.';
            }

            if (empty($errors['profile-picture'])) {
                if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $target_file)) {
                    $profile_picture = $target_file;
                } else {
                    $errors['profile-picture'] = 'Gagal mengupload file.';
                }
            }
        }

        // Jika tidak ada error, simpan data ke database
        if (empty($errors)) {
            $sql = "INSERT INTO users (name, email, password, gender, profile_picture) VALUES ('$name', '$email', '$password', '$gender', '$profile_picture')";
            if ($conn->query($sql) === TRUE) {
                // Kirim email konfirmasi
                $to = $email;
                $subject = "Konfirmasi Registrasi";
                $message = "Terima kasih telah mendaftar, $name!";
                $headers = "From: no-reply@example.com";

                if (mail($to, $subject, $message, $headers)) {
                    // Redirect ke halaman sukses
                    header("Location: welcome.php");
                    exit();
                } else {
                    $errors['email'] = 'Gagal mengirim email konfirmasi.';
                }
            } else {
                $errors['database'] = 'Error: ' . $sql . '<br>' . $conn->error;
            }
        }
    }
}

// Generate CSRF token
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <?php include "layout/header.html"; ?>

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg md:w-1/2 lg:w-1/3 mx-auto mt-12">
        <h3 class="text-2xl font-bold text-center mb-6 text-gray-800">Register</h3>
        <form action="register.php" method="POST" enctype="multipart/form-data" class="space-y-6" onsubmit="return validateForm()">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" placeholder="Enter your full name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <?php if (isset($errors['name'])): ?>
                    <p id="name-error" class="text-red-500 text-sm mt-1"><?php echo $errors['name']; ?></p>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <?php if (isset($errors['email'])): ?>
                    <p id="email-error" class="text-red-500 text-sm mt-1"><?php echo $errors['email']; ?></p>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <?php if (isset($errors['password'])): ?>
                    <p id="password-error" class="text-red-500 text-sm mt-1"><?php echo $errors['password']; ?></p>
                <?php endif; ?>
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <?php if (isset($errors['confirm-password'])): ?>
                    <p id="confirm-password-error" class="text-red-500 text-sm mt-1"><?php echo $errors['confirm-password']; ?></p>
                <?php endif; ?>
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="male" class="form-radio h-4 w-4 text-indigo-600" required>
                        <span class="ml-2 text-gray-700">Laki-laki</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="female" class="form-radio h-4 w-4 text-indigo-600" required>
                        <span class="ml-2 text-gray-700">Perempuan</span>
                    </label>
                </div>
                <?php if (isset($errors['gender'])): ?>
                    <p id="gender-error" class="text-red-500 text-sm mt-1"><?php echo $errors['gender']; ?></p>
                <?php endif; ?>
            </div>

            <!-- Upload Foto Profil -->
            <div>
                <label for="profile-picture" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                <input type="file" name="profile-picture" id="profile-picture" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <?php if (isset($errors['profile-picture'])): ?>
                    <p id="profile-picture-error" class="text-red-500 text-sm mt-1"><?php echo $errors['profile-picture']; ?></p>
                <?php endif; ?>
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-center">
                <input type="checkbox" name="terms" id="terms" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" required>
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    Saya setuju dengan <a href="#" class="text-indigo-600 hover:text-indigo-500">syarat dan ketentuan</a>.
                </label>
            </div>
            <?php if (isset($errors['terms'])): ?>
                <p id="terms-error" class="text-red-500 text-sm mt-1"><?php echo $errors['terms']; ?></p>
            <?php endif; ?>

            <!-- Captcha -->
            <div class="g-recaptcha" data-sitekey="your_site_key"></div>
            <?php if (isset($errors['captcha'])): ?>
                <p id="captcha-error" class="text-red-500 text-sm mt-1"><?php echo $errors['captcha']; ?></p>
            <?php endif; ?>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Register
            </button>
        </form>
    </div>

    <?php include "layout/footer.html"; ?>
</body>
</html>