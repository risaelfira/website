<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = htmlspecialchars($_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $pesan = htmlspecialchars($_POST['pesan']);

  // Simulasi pengiriman atau penyimpanan
  $to = "your@email.com"; // Ganti dengan email Anda
  $subject = "Pesan dari $nama";
  $message = "Nama: $nama\nEmail: $email\nPesan:\n$pesan";
  $headers = "From: $email";

  // Kirim email (jika server mendukung)
  // mail($to, $subject, $message, $headers);

  // Redirect kembali dengan pesan sukses
  header("Location: index.php?success=1");
  exit();
}
?>
