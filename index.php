<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
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
    <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
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

  <!-- Hero -->
  <section class="relative h-screen flex items-center justify-center overflow-hidden pt-28">
    <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
      <source src="COREMAP-CTI%EF%BC%9A%20Upaya%20Indonesia%20untuk%20Melestarikan%20Terumbu%20Karang%20yang%20Berperan%20Penting%20bagi%20Kehidupan.mp4" type="video/mp4" />
      Browser Anda tidak mendukung
    </video>
    <div class="absolute inset-0 bg-black/50 backdrop-brightness-75 z-10"></div>

    <div class="relative z-20 text-white text-center px-4 md:px-8 max-w-3xl animate-fade-in">
      <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-md">Coral paradise beneath the sea</h1>
      <p class="text-lg md:text-xl mb-6 drop-shadow">
        Millions of living creatures around the world depend on coral reefs for their survival. Despite facing numerous disasters and climate change, science reveals that coral reefs can endure—if we choose to protect them.
      </p>
      <button onclick="scrollToSection('features')" class="bg-blue-600 hover:bg-blue-700 transition px-6 py-2 rounded-full text-white shadow-lg">Explore</button>
    </div>

    <div class="absolute bottom-4 left-4 z-20 text-white text-xs md:text-sm bg-black/30 backdrop-blur-md px-4 py-2 rounded-lg shadow-md flex items-center gap-2 animate-fade-in">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
        <path d="M19.615 3.184c-2.137-.525-10.08-.525-12.217 0C4.523 3.686 3.692 5.38 3.692 12s.831 8.314 3.706 8.816c2.137.525 10.08.525 12.217 0C21.477 20.314 22.308 18.62 22.308 12s-.831-8.314-3.693-8.816zM10.5 15.5v-7l6 3.5-6 3.5z"/>
      </svg>
      <span>
        Video: <a href="https://www.youtube.com/watch?v=YY__UioSuUc" target="_blank" class="underline hover:text-blue-300 transition">COREMAP-CTI by World Bank</a>
      </span>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="py-16 bg-white scroll-mt-32">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <h2 class="text-3xl md:text-4xl font-bold mb-6 text-blue-700">About Us</h2>
      <p class="text-lg leading-relaxed text-center mb-10">
        Indonesia is home to some of the world’s most diverse coral reefs, vital to the survival of countless marine species. Through coral cultivation—such as fragment planting and reef restoration—communities are working to revive damaged ecosystems. Protecting and caring for these reefs is essential, not only to preserve marine biodiversity but also to support the livelihoods of coastal populations. With collective action, we can ensure that these underwater treasures continue to thrive for generations to come.
      </p>
    </div>
  </section>

  <!-- Features -->
  <section id="features" class="py-16 bg-white scroll-mt-32">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-4xl md:text-5xl font-extrabold text-center text-cyan-600 mb-10 tracking-tight leading-tight">Main Goals</h2>

      <!-- Feature 1 -->
      <div class="relative grid md:grid-cols-[41%_auto] grid-cols-1 gap-6 items-center overflow-hidden shadow-xl rounded-lg bg-gradient-to-r from-blue-500 to-teal-300 mb-14">
        <div class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center text-white border-2 border-white rounded-full text-base font-bold bg-blue-700 bg-opacity-60 backdrop-blur">1</div>
        <figure class="w-full h-full">
          <img src="https://coral.org/wp-content/uploads/2021/08/coral-loving-the-ocean.jpg" alt="Loving the Ocean" class="w-full h-full object-cover" width="930" height="700" />
        </figure>
        <div class="p-10 text-white">
          <h3 class="text-2xl md:text-3xl font-bold mb-4">Loving the Ocean</h3>
          <p class="text-lg leading-relaxed">
            We came into existence because of the reverence and wonderment that people have for corals and the beautiful environments they create.
          </p>
        </div>
      </div>

      <!-- Feature 2 -->
      <div class="relative grid md:grid-cols-[41%_auto] grid-cols-1 gap-6 items-center overflow-hidden shadow-xl rounded-lg bg-gradient-to-r from-green-400 to-lime-300 mb-14">
        <div class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center text-white border-2 border-white rounded-full text-base font-bold bg-green-700 bg-opacity-60 backdrop-blur">2</div>
        <figure class="w-full h-full">
          <img src="https://static.coral.org/uploads/2021/08/coral-finding-our-sea-legs.jpg" alt="Finding Our Sea Legs" class="w-full h-full object-cover" width="930" height="700" />
        </figure>
        <div class="p-10 text-white">
          <h3 class="text-2xl md:text-3xl font-bold mb-4">Finding Our Sea Legs</h3>
          <p class="text-lg leading-relaxed">
            This appreciation turned into a mission that galvanized the SCUBA diving community to take action to protect coral reefs.
          </p>
        </div>
      </div>

      <!-- Feature 3 -->
      <div class="relative grid md:grid-cols-[41%_auto] grid-cols-1 gap-6 items-center overflow-hidden shadow-xl rounded-lg bg-gradient-to-r from-rose-400 to-red-300 mb-14">
        <div class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center text-white border-2 border-white rounded-full text-base font-bold bg-red-700 bg-opacity-60 backdrop-blur">3</div>
        <figure class="w-full h-full">
          <img src="https://coral.org/wp-content/uploads/2021/08/coral-leading-with-hope.jpg" alt="Leading with Hope" class="w-full h-full object-cover" width="930" height="700" />
          <figcaption class="text-white text-sm px-4 pt-2">Photo by Roatán Marine Park</figcaption>
        </figure>
        <div class="p-10 text-white">
          <h3 class="text-2xl md:text-3xl font-bold mb-4">Leading with Hope</h3>
          <p class="text-lg leading-relaxed">
            Today, our research that shows corals can adapt to climate change gives us, and our partners, hope. We’re partnering with communities, NGOs, governments, and others to turn our science into action around the world.
          </p>
        </div>
      </div>

      <!-- Feature 4 -->
      <div class="relative grid md:grid-cols-[41%_auto] grid-cols-1 gap-6 items-center overflow-hidden shadow-xl rounded-lg bg-gradient-to-r from-rose-500 to-blue-900 mb-14">
        <div class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center text-white border-2 border-white rounded-full text-base font-bold bg-blue-900 bg-opacity-60 backdrop-blur">4</div>
        <figure class="w-full h-full">
          <img src="https://static.coral.org/uploads/2021/08/coral-leading-the-way.jpg" alt="Leading the Way" class="w-full h-full object-cover" width="930" height="700" />
        </figure>
        <div class="p-10 text-white">
          <h3 class="text-2xl md:text-3xl font-bold mb-4">Leading the Way</h3>
          <p class="text-lg leading-relaxed">
            Our collective work at local, regional, and global scales positions us to ensure that coral reefs flourish and provide benefits to humans and wildlife for generations to come.
          </p>
        </div>
      </div>
    </div>
  </section>

  <?php if (!isset($_SESSION['user'])): ?>
    <!-- Login -->
    <section id="contact" class="py-20 bg-white">
      <div class="max-w-lg mx-auto px-6 md:px-10">
        <h2 id="login-section" class="text-3xl md:text-4xl font-bold mb-8 text-center text-blue-700">Log In</h2>

        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
          <p class="text-red-600 mb-6 text-center text-base md:text-lg">Email/Username atau Password salah.</p>
        <?php endif; ?>

        <form action="login.php" method="POST" class="space-y-6 text-base md:text-lg">
          <input type="text" name="identifier" placeholder="Username"
            class="w-full px-5 py-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required />

          <input type="password" name="password" placeholder="Password"
            class="w-full px-5 py-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
            required />

          <div class="text-center">
            <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-md transition text-lg md:text-xl">
              Log In
            </button>
          </div>
        </form>

        <?php if (isset($_GET['not_logged_in'])): ?>
          <p class="text-red-600 mt-6 text-center font-medium text-base md:text-lg">
            Silakan login terlebih dahulu untuk mengakses halaman tersebut.
          </p>
        <?php endif; ?>

        <p class="text-center text-sm md:text-base text-gray-600 mt-6">
          Belum punya akun?
          <a href="register.php" class="text-blue-600 hover:underline font-medium">Sign Up</a>
        </p>
      </div>
    </section>
  <?php endif; ?>

  <!-- Footer -->
  <footer class="text-center py-6 bg-gray-200 mt-10">
    <p>&copy; Dibuat oleh aku❤️</p>
  </footer>

</body>
</html>