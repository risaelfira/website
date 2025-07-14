<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user'])){
  header("Location: index.php?not_logged_in=1#login-section");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Coral Interaction</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function scrollToSection(id) {
      document.getElementById(id).scrollIntoView({ behavior: "smooth" });
    }

    function toggleDropdown() {
      const dropdown = document.getElementById("userDropdown");
      dropdown.classList.toggle("hidden");
    }

    function toggleDropdownMenu() {
      const menu = document.getElementById("terumbuDropdown");
      menu.classList.toggle("hidden");
    }

    document.addEventListener("click", function (event) {
      const userDropdown = document.getElementById("userDropdown");
      const terumbuDropdown = document.getElementById("terumbuDropdown");

      const clickedButton = event.target.closest("button");
      const clickedInsideUser = userDropdown?.contains(event.target);
      const clickedInsideTerumbu = terumbuDropdown?.contains(event.target);

      if (!clickedInsideUser && (!clickedButton || clickedButton.innerText !== 'User')) {
        userDropdown?.classList.add("hidden");
      }

      if (!clickedInsideTerumbu && (!clickedButton || clickedButton.innerText !== 'Terumbu Karang')) {
        terumbuDropdown?.classList.add("hidden");
      }
    });

    window.addEventListener('DOMContentLoaded', () => {
      if (window.location.hash === "#contact") {
        const section = document.getElementById("contact");
        if (section) {
          section.scrollIntoView({ behavior: "smooth" });
        }
      }
    });
  </script>
</head>

<body id="top" class="bg-gray-100 text-gray-800 font-sans">

<?php
// Enkripsi/dekripsi
define('ENCRYPTION_KEY', 'your-32-char-secret-key-1234567890');
define('ENCRYPTION_IV', '1234567890123456');
function decrypt($data) {
    return openssl_decrypt($data, 'AES-256-CBC', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
}

if (isset($_SESSION['user']['name']) && strpos($_SESSION['user']['name'], '=') !== false) {
    $_SESSION['user']['name'] = decrypt($_SESSION['user']['name']);
}
if (isset($_SESSION['user']['email']) && strpos($_SESSION['user']['email'], '=') !== false) {
    $_SESSION['user']['email'] = decrypt($_SESSION['user']['email']);
}
?>

  <!-- Navbar -->
  <nav class="bg-white shadow-md fixed w-full top-0 z-30">
    <div class="w-full py-6 px-6 flex justify-between items-center">
      <!-- Judul -->
      <a href="index.php" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="text-2xl md:text-3xl font-bold text-blue-600 hover:text-blue-800 transition">CoralInteraction</a>

      <div class="space-x-4 hidden md:flex text-base md:text-lg">
        <button onclick="scrollToSection('about')" class="hover:text-blue-500 transition"><a href="about.php">About</a></button>

        <!-- Dropdown Terumbu Karang -->
        <div class="relative">
          <button onclick="toggleDropdownMenu()" class="hover:text-blue-500 transition">Terumbu Karang</button>
          <div id="terumbuDropdown" class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden z-50">
            <a href="terumbu_karang.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tentang Terumbu Karang</a>
            <a href="jenis_terumbu.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Jenis Terumbu Karang</a>
          </div>
        </div>

        <?php if (isset($_SESSION['user'])): ?>
          <div class="relative">
            <button onclick="toggleDropdown()" class="hover:text-blue-500 transition">User</button>
            <div id="userDropdown" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg p-4 hidden z-50">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-pink-500 text-white flex items-center justify-center rounded-full text-xl font-bold">
                  <?= isset($_SESSION['user']['name']) ? strtoupper(substr(htmlspecialchars($_SESSION['user']['name']), 0, 1)) : '?' ?>
                </div>
                <div>
                  <p class="font-semibold"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Nama tidak tersedia') ?></p>
                  <p class="text-sm text-gray-500"><?= htmlspecialchars($_SESSION['user']['email'] ?? 'Email tidak tersedia') ?></p>
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


  <!-- Header -->
  <section class="pt-28 relative w-full h-[400px] bg-cover bg-center flex items-center justify-center text-white"
           style="background-image: url('https://www.mldspot.com/storage/generated/June2021/keindahan-terumbu-karang.jpg');">
    <div class="absolute inset-0 bg-black/50"></div>
    <h1 class="text-4xl md:text-5xl font-bold relative z-10 text-center px-4 drop-shadow-lg">
      Terumbu Karang Indonesia
    </h1>
    <p class="absolute bottom-2 left-4 text-xs text-white z-10">
      Sumber gambar: <a href="https://www.mldspot.com/" target="_blank" class="underline hover:text-blue-300">mldspot.com</a>
    </p>
  </section>

  <!-- Konten -->
  <main class="pt-28 px-4 max-w-4xl mx-auto space-y-8 text-lg leading-relaxed text-gray-800 animate-fade-in">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-cyan-700 mb-6">Keindahan dan Peran Terumbu Karang</h2>

    <p class="italic text-justify">
      Di kedalaman biru samudra, tersembunyi sebuah keajaiban yang memesona – <strong>terumbu karang</strong>, kota kehidupan yang berdenyut dalam diam.
    </p>

    <p class="text-justify">
      Lebih dari sekadar batuan di dasar laut, terumbu karang adalah <strong>arsitek alam</strong> yang menciptakan rumah bagi ribuan spesies laut dan melukiskan lanskap bawah air dengan warna-warni yang memukau.
    </p>

    <div class="border-l-4 border-blue-400 pl-4 italic text-gray-700">
      “Bayangkan menyelam ke dunia yang sunyi, di mana setiap sudut memancarkan keindahan tak terlukiskan.”
    </div>

    <p class="text-justify">
      Di sinilah terumbu karang menampilkan pesonanya — dari <span class="text-blue-700 font-semibold">koral bercabang</span> yang menjulang anggun, hingga <span class="text-blue-700 font-semibold">koral meja</span> yang datar dan luas menyerupai taman rahasia. Setiap bentuk dan warna adalah <em>mahakarya alam</em> yang menakjubkan.
    </p>

    <p class="text-justify">
      Namun, keindahan ini bukan hanya visual. Terumbu karang adalah <strong class="text-green-700">jantung kehidupan ekosistem laut</strong>, rumah bagi lebih dari 25% spesies laut dunia, meskipun hanya menempati kurang dari 1% dasar laut.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white shadow-md rounded-lg p-6 border-l-4 border-cyan-500">
      <p class="text-justify">
        <strong class="text-pink-600">Pelindung garis pantai:</strong> Struktur kokohnya meredam ombak dan badai, mengurangi erosi, dan melindungi masyarakat pesisir dari bencana alam.
      </p>
      <p class="text-justify">
        <strong class="text-pink-600">Sumber kehidupan:</strong> Menjadi tempat berlindung, berkembang biak, dan mencari makan bagi jutaan makhluk laut, termasuk ikan, penyu, dan teripang.
      </p>
    </div>

    <p class="text-justify">
      Sayangnya, <strong class="text-red-600">keajaiban ini kini terancam</strong> akibat perubahan iklim, polusi, dan aktivitas manusia yang tidak bertanggung jawab. Tanpa perlindungan, permata laut ini bisa hilang selamanya.
    </p>

    <div class="text-center text-xl font-semibold text-blue-600 bg-blue-50 border border-blue-200 rounded-lg p-6 shadow">
      Mari bersama-sama <span class="underline">melestarikan terumbu karang</span> demi masa depan samudra dan kehidupan bumi
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center py-6 bg-gray-200 mt-16">
    <p>&copy; Dibuat oleh ......</p>
  </footer>

</body>
</html>
