<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Jika pakai Composer
// require 'PHPMailer/src/Exception.php'; // Jika install manual
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Gunakan SMTP Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // Ganti dengan email kamu
    $mail->Password = 'your-app-password'; // Ganti dengan App Password Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // Gunakan port 587 untuk TLS

    // Pengaturan email
    $mail->setFrom('your-email@gmail.com', 'Nama Kamu'); // Email pengirim
    $mail->addAddress('recipient@example.com', 'Nama Penerima'); // Email penerima
    $mail->Subject = 'Judul Email';
    $mail->Body = 'Ini adalah isi email yang dikirim menggunakan PHPMailer.';

    // Kirim email
    $mail->send();
    echo 'Email berhasil dikirim!';
} catch (Exception $e) {
    echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
}
?>
