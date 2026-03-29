async function loadComponent(elementId, componentPath) {
  try {
    const response = await fetch(componentPath);
    const html = await response.text();
    document.getElementById(elementId).innerHTML = html;
  } catch (error) {
    console.error(`Error loading ${componentPath}:`, error);
  }
}

function initNav() {
  const token = localStorage.getItem("token");
  const navButtons = document.getElementById("nav-buttons");
  const mobileNavButtons = document.getElementById("mobile-nav-buttons");

  const cfg = window.APP_CONFIG || {};
  const githubUrl = cfg.GITHUB_URL || "#";

  const navContent = token
    ? `
      <div>
        <a href="${githubUrl}" target="_blank" rel="noopener" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fab fa-github"></i> GitHub
        </a>
        <a href="pricing.html" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fas fa-tags me-1"></i>Pricing
        </a>
        <a href="gift.html" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fas fa-gift me-1"></i>Gift Card
        </a>
        <a href="press.html" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fas fa-newspaper me-1"></i>Press
        </a>
        <a href="contact.html" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fas fa-envelope me-1"></i>Contact
        </a>
      </div>
      <div class="dropdown d-inline-block documentation-btn">
        <button class="btn btn-link text-decoration-none dropdown-toggle" type="button" id="docDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: #b8605c">
          <i class="fas fa-book me-1"></i>Documentation
        </button>
        <ul class="dropdown-menu" aria-labelledby="docDropdown" style="border: 1px solid var(--color-inactive); box-shadow: 0 10px 30px rgba(184, 96, 92, 0.2);">
          <li><a class="dropdown-item" href="documentation.html?page=getting-started" style="color: var(--color-text-primary); transition: all 0.3s ease;"><i class="fas fa-rocket me-2" style="color: var(--color-primary);"></i>Getting Started</a></li>
          <li><a class="dropdown-item" href="documentation.html?page=first-step" style="color: var(--color-text-primary); transition: all 0.3s ease;"><i class="fas fa-headphones me-2" style="color: var(--color-primary);"></i>First Step</a></li>
          <li><a class="dropdown-item" href="documentation.html?page=bank-management" style="color: var(--color-text-primary); transition: all 0.3s ease;"><i class="fas fa-database me-2" style="color: var(--color-primary);"></i>Bank Management</a></li>
          <li><a class="dropdown-item" href="documentation.html?page=draw-to-audio" style="color: var(--color-text-primary); transition: all 0.3s ease;"><i class="fas fa-paint-brush me-2" style="color: var(--color-primary);"></i>Draw to Audio</a></li>
        </ul>
      </div>
      <a href="dashboard.html" class="btn btn-success btn-sm me-2 fw-bold">
        <i class="fas fa-chart-line me-1"></i>Dashboard
      </a>
      <button onclick="logout()" class="btn btn-success btn-sm fw-bold">
        <i class="fas fa-sign-out-alt me-1"></i>Logout
      </button>
    `
    : `
      <div>
        <a href="${githubUrl}" target="_blank" rel="noopener" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fab fa-github"></i> GitHub
        </a>
        <a href="pricing.html" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fas fa-tags me-1"></i>Pricing
        </a>
        <a href="gift.html" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fas fa-gift me-1"></i>Gift Card
        </a>
        <a href="press.html" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fas fa-newspaper me-1"></i>Press
        </a>
        <a href="contact.html" class="btn btn-link text-decoration-none" style="color: #b8605c">
          <i class="fas fa-envelope me-1"></i>Contact
        </a>
      </div>
      <div class="dropdown d-inline-block me-2 documentation-btn">
        <button class="btn btn-link text-decoration-none dropdown-toggle" type="button" id="docDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: #b8605c">
          <i class="fas fa-book me-1"></i>Documentation
        </button>
        <ul class="dropdown-menu" aria-labelledby="docDropdown" style="border: 1px solid var(--color-inactive); box-shadow: 0 10px 30px rgba(184, 96, 92, 0.2);">
          <li><a class="dropdown-item" href="documentation.html?page=getting-started" style="color: var(--color-text-primary); transition: all 0.3s ease;"><i class="fas fa-rocket me-2" style="color: var(--color-primary);"></i>Getting Started</a></li>
          <li><a class="dropdown-item" href="documentation.html?page=first-step" style="color: var(--color-text-primary); transition: all 0.3s ease;"><i class="fas fa-headphones me-2" style="color: var(--color-primary);"></i>First Step</a></li>
          <li><a class="dropdown-item" href="documentation.html?page=bank-management" style="color: var(--color-text-primary); transition: all 0.3s ease;"><i class="fas fa-database me-2" style="color: var(--color-primary);"></i>Bank Management</a></li>
          <li><a class="dropdown-item" href="documentation.html?page=draw-to-audio" style="color: var(--color-text-primary); transition: all 0.3s ease;"><i class="fas fa-paint-brush me-2" style="color: var(--color-primary);"></i>Draw to Audio</a></li>
        </ul>
      </div>
      <a href="login.html" class="btn btn-success btn-sm me-2 fw-bold">Login</a>
      <a href="register.html" class="btn btn-success btn-sm fw-bold">Sign Up Free</a>
    `;

  navButtons.innerHTML = navContent;
  mobileNavButtons.innerHTML = navContent;

  const toggler = document.getElementById("navbarToggler");
  const mobileMenu = document.getElementById("mobile-menu");

  if (toggler && mobileMenu) {
    toggler.addEventListener("click", function () {
      if (
        mobileMenu.style.display === "none" ||
        mobileMenu.style.display === ""
      ) {
        mobileMenu.style.display = "block";
        toggler.querySelector("i").classList.replace("fa-bars", "fa-times");
      } else {
        mobileMenu.style.display = "none";
        toggler.querySelector("i").classList.replace("fa-times", "fa-bars");
      }
    });

    document.addEventListener("click", function (event) {
      if (!event.target.closest(".navbar")) {
        mobileMenu.style.display = "none";
        toggler.querySelector("i").classList.replace("fa-times", "fa-bars");
      }
    });
  }
}

window.logout = function () {
  localStorage.removeItem("token");
  window.location.href = "index.html";
};

document.addEventListener("DOMContentLoaded", async () => {
  await loadComponent("nav-container", "./components/nav.html");
  await loadComponent("footer-container", "./components/footer.html");
  initNav();
});
