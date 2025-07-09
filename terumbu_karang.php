<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: index.php?not_logged_in=1#contact");
  exit();
}
?>

<?php if (isset($_GET['not_logged_in'])): ?>
  <p class="text-red-600 mb-4 text-center font-medium">Silakan login terlebih dahulu untuk mengakses halaman tersebut.</p>
<?php endif; ?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Terumbu Karang Indonesia - Coral Interaction</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function scrollToSection(id) {
      window.location.href = 'index.php#' + id;
    }
    function toggleDropdown() {
      const dropdown = document.getElementById("userDropdown");
      dropdown.classList.toggle("hidden");
    }
    document.addEventListener("click", function(event) {
      const dropdown = document.getElementById("userDropdown");
      const button = event.target.closest("button");
      if (!dropdown.contains(event.target) && (!button || button.innerText !== 'User')) {
        dropdown.classList.add("hidden");
      }
    });
  </script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

  <!-- Navbar -->
  <nav class="bg-white shadow-md fixed w-full top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <a href="index.php" class="text-xl font-bold text-blue-600 hover:text-blue-800 transition">CoralInteraction</a>
      <div class="space-x-4 hidden md:flex">
        <button onclick="scrollToSection('about')" class="hover:text-blue-500 transition">About</button>
        <button onclick="scrollToSection('features')" class="hover:text-blue-500 transition">Goals</button>
        <button onclick="window.location.href='terumbu_karang.php'" class="text-blue-600 font-semibold">Terumbu Karang</button>
        <?php if (isset($_SESSION['user'])): ?>
          <div class="relative">
            <button onclick="toggleDropdown()" class="hover:text-blue-500 transition">User</button>
            <div id="userDropdown" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg p-4 hidden z-50">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-pink-500 text-white flex items-center justify-center rounded-full text-xl font-bold">
                  <?= isset($_SESSION['user']['name']) ? strtoupper(substr($_SESSION['user']['name'], 0, 1)) : '?' ?>
                </div>
                <div>
                  <p class="font-semibold"><?= isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : 'Nama tidak tersedia' ?></p>
                  <p class="text-sm text-gray-500"><?= isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : 'Email tidak tersedia' ?></p>
                </div>
              </div>
              <form action="logout.php" method="POST">
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-md">Sign out</button>
              </form>
            </div>
          </div>
        <?php else: ?>
          <button onclick="scrollToSection('contact')" class="hover:text-blue-500 transition">Login</button>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  
  <!-- Header dengan Background Gambar & Kredit -->
  <section class="pt-28 relative w-full h-[400px] bg-cover bg-center flex items-center justify-center text-white"
            style="background-image: url('https://www.mldspot.com/storage/generated/June2021/keindahan-terumbu-karang.jpg');">
  
    <!-- Overlay gelap supaya teks terbaca -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Judul halaman -->
    <h1 class="text-4xl md:text-5xl font-bold relative z-10 text-center px-4 drop-shadow-lg">
      Terumbu Karang Indonesia
    </h1>

    <!-- Kredit gambar -->
    <p class="absolute bottom-2 left-4 text-xs text-white z-10">
      Sumber gambar: <a href="https://www.mldspot.com/" target="_blank" class="underline hover:text-blue-300">mldspot.com</a>
    </p>
  </section>

  <!-- Content -->
  <main class="pt-28 px-4 max-w-4xl mx-auto">
    <p class="text-lg leading-relaxed text-justify mb-6">
      Di Indonesia, yang berada di pusat Segitiga Terumbu Karang Dunia, terdapat lebih dari 500 spesies karang dan sekitar 51.000 km² area terumbu karang. Beberapa jenis yang umum ditemukan antara lain Acropora cervicornis yang bercabang halus, Acropora humilis yang berbentuk seperti meja, Montipora aquituberculata yang bentuknya berubah tergantung kedalaman, serta karang berbentuk piring seperti Fungia, dan jenis bercabang cerah seperti Pocillopora dan Stylophora.
    </p>
    <p class="text-lg leading-relaxed text-justify">
      Sayangnya, terumbu karang menghadapi berbagai ancaman seperti perubahan iklim, polusi, dan aktivitas manusia yang merusak, sehingga upaya konservasi dan restorasi sangat penting untuk menjaga kelestarian laut Indonesia.
    </p>
  </main>

  <!-- Footer -->
  <footer class="text-center py-6 bg-gray-200 mt-16">
    <p>&copy; Dibuat oleh ....</p>
  </footer>

</body>
</html>
