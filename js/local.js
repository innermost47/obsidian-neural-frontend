document.addEventListener("DOMContentLoaded", () => {
  const buttons = document.querySelectorAll(
    "#btn-buy-local, #btn-buy-local-cta",
  );
  const errorEl = document.getElementById("buy-error");

  async function startCheckout(btn) {
    const original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML =
      '<i class="fas fa-circle-notch fa-spin mr-2"></i>Redirecting...';
    if (errorEl) errorEl.classList.add("hidden");

    try {
      const data = await API.createLocalCheckout();
      if (data.checkout_url) {
        window.location.href = data.checkout_url;
      } else {
        throw { detail: "No checkout URL returned" };
      }
    } catch (error) {
      btn.disabled = false;
      btn.innerHTML = original;
      if (errorEl) {
        errorEl.textContent =
          error.detail || "Something went wrong. Please try again.";
        errorEl.classList.remove("hidden");
      }
      console.error("Local checkout failed:", error);
    }
  }

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => startCheckout(btn));
  });
});
