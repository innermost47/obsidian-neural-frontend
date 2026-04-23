<nav
  class="fixed top-6 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl z-50 bg-[#1a1a1c]/70 backdrop-blur-xl border border-white/10 rounded-full px-4 lg:px-6 py-3 flex items-center justify-between shadow-2xl">
  <a
    href="index.php"
    class="flex items-center gap-2.5 text-primary font-black tracking-widest text-sm lg:text-base hover:opacity-80 transition-opacity shrink-0">
    <img src="assets/images/logo.png" alt="logo" class="h-6 lg:h-7" />
    <span id="nav-site-name">OBSIDIAN NEURAL</span>
  </a>

  <button
    class="lg:hidden text-primary text-xl w-10 h-10 flex items-center justify-center rounded-full hover:bg-white/5 transition-colors"
    onclick="toggleMobileMenu()"
    aria-label="Toggle navigation">
    <i class="fas fa-bars" id="burger-icon"></i>
  </button>

  <div class="hidden lg:flex items-center gap-1" id="nav-links">

    <div id="nav-extra-desktop" class="flex items-center gap-1"></div>
    <div id="nav-docs-desktop" class="flex items-center"></div>

    <a
      href="index.php#provider-network"
      class="nav-link-pill text-warning/80 hover:text-warning">Earn GPU</a>

    <div class="w-px h-5 bg-white/10 mx-1.5"></div>

    <div id="nav-auth-desktop" class="flex items-center gap-2"></div>

    <a
      id="nav-github"
      href="#"
      target="_blank"
      class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all text-xs">
      <i class="fab fa-github"></i>
    </a>
  </div>
</nav>

<div
  id="mobile-menu"
  class="fixed inset-0 z-[60] pointer-events-none opacity-0 transition-opacity duration-300 lg:hidden">
  <div
    class="absolute inset-0 bg-black/60 backdrop-blur-sm"
    onclick="toggleMobileMenu()"></div>
  <div
    id="mobile-panel"
    class="absolute top-0 right-0 h-full w-[85%] max-w-sm bg-[#111115] border-l border-white/10 transform translate-x-full transition-transform duration-300 overflow-y-auto">
    <div class="p-5">
      <div class="flex items-center justify-between mb-7">
        <span
          class="text-primary font-black tracking-widest text-sm"
          id="nav-site-name-mobile">OBSIDIAN NEURAL</span>
        <button
          onclick="toggleMobileMenu()"
          class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="space-y-1 mb-4">
        <a href="index.php" class="mobile-link active"><i class="fas fa-home w-5 text-primary"></i>Home</a>
      </div>

      <div id="nav-extra-mobile" class="space-y-1 mb-4"></div>

      <div id="nav-docs-mobile" class="mb-4"></div>

      <a
        href="index.php#provider-network"
        class="mobile-link"
        onclick="toggleMobileMenu()"><i class="fas fa-server w-5 text-warning"></i><span class="text-warning">Earn with GPU</span></a>
      <div id="nav-auth-mobile" class="space-y-3 mt-6"></div>
    </div>
  </div>
</div>

<script>
  (function() {
    document.addEventListener("DOMContentLoaded", () => {
      var token = localStorage.getItem("token");
      var cfg = window.APP_CONFIG || {};
      var githubUrl = cfg.GITHUB_URL || "#";

      var extraDesktop = document.getElementById("nav-extra-desktop");
      if (extraDesktop) {
        extraDesktop.innerHTML =
          '<a href="pricing.php" class="nav-link-pill">Pricing</a>' +
          '<a href="gift.php" class="nav-link-pill">Gift</a>' +
          '<a href="press.php" class="nav-link-pill">Press</a>' +
          '<a href="contact.php" class="nav-link-pill">Contact</a>';
      }

      var extraMobile = document.getElementById("nav-extra-mobile");
      if (extraMobile) {
        extraMobile.innerHTML =
          '<a href="pricing.php" class="mobile-link" onclick="toggleMobileMenu()"><i class="fas fa-tags w-5 text-track4"></i>Pricing</a>' +
          '<a href="gift.php" class="mobile-link" onclick="toggleMobileMenu()"><i class="fas fa-gift w-5 text-track7"></i>Gift Card</a>' +
          '<a href="press.php" class="mobile-link"><i class="fas fa-newspaper w-5 text-gray-400"></i>Press</a>' +
          '<a href="contact.php" class="mobile-link"><i class="fas fa-envelope w-5 text-gray-400"></i>Contact</a>';
      }

      var docDesktop = document.getElementById("nav-docs-desktop");
      if (docDesktop) {
        docDesktop.innerHTML =
          '<div class="relative group">' +
          '<button class="nav-link-pill flex items-center gap-1.5">Docs <i class="fas fa-chevron-down text-[9px] opacity-40 group-hover:opacity-100 transition-opacity"></i></button>' +
          '<div class="absolute top-full right-0 mt-2 w-52 bg-[#1a1a1c]/95 backdrop-blur-xl border border-white/10 rounded-xl overflow-hidden shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 -translate-y-1 group-hover:translate-y-0 z-50">' +
          '<a href="documentation.php?page=getting-started" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors"><i class="fas fa-rocket text-primary w-4 text-center"></i>Getting Started</a>' +
          '<a href="documentation.php?page=first-step" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors"><i class="fas fa-headphones text-primary w-4 text-center"></i>First Step</a>' +
          '<a href="documentation.php?page=bank-management" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors"><i class="fas fa-database text-primary w-4 text-center"></i>Bank Management</a>' +
          '<a href="documentation.php?page=draw-to-audio" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors"><i class="fas fa-paintbrush text-primary w-4 text-center"></i>Draw to Audio</a>' +
          "</div>" +
          "</div>";
      }

      var docMobile = document.getElementById("nav-docs-mobile");
      if (docMobile) {
        docMobile.innerHTML =
          "<div>" +
          "<button onclick=\"this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')\" class=\"mobile-link w-full justify-between\">" +
          '<span class="flex items-center gap-3"><i class="fas fa-book w-5 text-gray-400"></i>Documentation</span>' +
          '<i class="fas fa-chevron-down chevron text-[10px] text-gray-500 transition-transform duration-200"></i>' +
          "</button>" +
          '<div class="hidden pl-12 space-y-1 mt-1 mb-2">' +
          '<a href="documentation.php?page=getting-started" class="block py-2 text-sm text-gray-500 hover:text-white transition-colors">Getting Started</a>' +
          '<a href="documentation.php?page=first-step" class="block py-2 text-sm text-gray-500 hover:text-white transition-colors">First Step</a>' +
          '<a href="documentation.php?page=bank-management" class="block py-2 text-sm text-gray-500 hover:text-white transition-colors">Bank Management</a>' +
          '<a href="documentation.php?page=draw-to-audio" class="block py-2 text-sm text-gray-500 hover:text-white transition-colors">Draw to Audio</a>' +
          "</div>" +
          "</div>";
      }

      var authDesktop = document.getElementById("nav-auth-desktop");
      if (authDesktop) {
        if (token) {
          authDesktop.innerHTML =
            '<a href="dashboard.php" class="px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-bold hover:bg-white/10 transition-all whitespace-nowrap"><i class="fas fa-chart-line mr-1.5"></i>Dashboard</a>' +
            '<button onclick="window._logout()" class="px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-bold text-gray-400 hover:text-white hover:bg-white/10 transition-all"><i class="fas fa-sign-out-alt"></i></button>';
        } else {
          authDesktop.innerHTML =
            '<a href="register.php" class="px-5 py-2 rounded-full bg-gradient-to-r from-primary to-[#a04840] text-white text-sm font-bold hover:scale-105 transition-transform shadow-[0_0_15px_rgba(217,104,80,0.3)] whitespace-nowrap"><i class="fas fa-rocket mr-1.5"></i>Start Free</a>';
        }
      }

      var authMobile = document.getElementById("nav-auth-mobile");
      if (authMobile) {
        if (token) {
          authMobile.innerHTML =
            '<a href="dashboard.php" class="block w-full text-center px-6 py-3 rounded-xl bg-white/5 border border-white/10 font-bold hover:bg-white/10 transition-colors"><i class="fas fa-chart-line mr-2"></i>Dashboard</a>' +
            '<button onclick="window._logout(); toggleMobileMenu();" class="block w-full text-center px-6 py-3 rounded-xl bg-white/5 border border-white/10 font-bold text-gray-400 hover:text-white hover:bg-white/10 transition-colors"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>';
        } else {
          authMobile.innerHTML =
            '<a href="register.php" class="block w-full text-center px-6 py-3.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(217,104,80,0.3)]"><i class="fas fa-rocket mr-2"></i>Start Free — 20 Credits</a>' +
            '<a id="nav-github-mobile" href="' +
            githubUrl +
            '" target="_blank" class="block w-full text-center px-6 py-3.5 rounded-xl bg-white/5 border border-white/10 font-bold hover:bg-white/10 transition-colors"><i class="fab fa-github mr-2"></i>Download on GitHub</a>';
        }
      }

      var ghDesktop = document.getElementById("nav-github");
      if (ghDesktop && githubUrl !== "#") ghDesktop.href = githubUrl;
    });
  })();


  window.toggleMobileMenu = function() {
    const menu = document.getElementById('mobile-menu');
    const panel = document.getElementById('mobile-panel');
    const icon = document.getElementById('burger-icon');

    if (!menu || !panel) return;

    const isOpen = !menu.classList.contains('pointer-events-none');

    if (isOpen) {
      menu.classList.add('pointer-events-none', 'opacity-0');
      panel.classList.add('translate-x-full');
      if (icon) icon.className = 'fas fa-bars';
    } else {
      menu.classList.remove('pointer-events-none', 'opacity-0');
      panel.classList.remove('translate-x-full');
      if (icon) icon.className = 'fas fa-times';
    }
  };

  window._logout = function() {
    localStorage.removeItem("token");
    window.location.href = "index.php";
  };
</script>