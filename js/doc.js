// Smooth scrolling for navigation links
document.querySelectorAll(".tutorial-nav a").forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();

    // Remove active class from all links
    document.querySelectorAll(".tutorial-nav a").forEach((link) => {
      link.classList.remove("active");
    });

    // Add active class to clicked link
    this.classList.add("active");

    // Smooth scroll to section
    const targetId = this.getAttribute("href");
    const targetSection = document.querySelector(targetId);

    if (targetSection) {
      targetSection.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

// Update active navigation on scroll
window.addEventListener("scroll", function () {
  let current = "";
  const sections = document.querySelectorAll(".step-section");

  sections.forEach((section) => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.clientHeight;
    if (pageYOffset >= sectionTop - 200) {
      current = section.getAttribute("id");
    }
  });

  document.querySelectorAll(".tutorial-nav a").forEach((link) => {
    link.classList.remove("active");
    if (link.getAttribute("href") === `#${current}`) {
      link.classList.add("active");
    }
  });
});
