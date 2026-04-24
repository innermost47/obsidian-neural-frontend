document.addEventListener("DOMContentLoaded", async () => {
  const params = new URLSearchParams(window.location.search);
  const page = params.get("page") || "getting-started";

  const contentContainer = document.getElementById("content");

  try {
    const response = await fetch(`docs/${page}.php`);
    if (!response.ok) throw new Error("Page not found");
    const html = await response.text();
    contentContainer.innerHTML = html;

    if (typeof initDocScripts === "function") initDocScripts();

    contentContainer.classList.add("fade-in");
  } catch (err) {
    contentContainer.innerHTML = `
      <div class="container py-5 text-center">
        <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
        <h2>Page not found</h2>
        <p class="text-muted">The requested documentation page could not be loaded.</p>
      </div>
    `;
  }

  function highlightActiveDocPage(page) {
    const links = document.querySelectorAll(".doc-page-link");
    links.forEach((link) => {
      const pageName = link.getAttribute("data-page");
      if (pageName === page) {
        link.classList.add("active");
      } else {
        link.classList.remove("active");
      }
    });
  }

  highlightActiveDocPage(page);
});
