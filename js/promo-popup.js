// Promotional Popup Manager
// Displays a 100% first month discount popup with date validation and localStorage persistence

(function () {
  "use strict";

  // Configuration
  const PROMO_CONFIG = {
    code: "OBSIDIAN100",
    endDate: new Date("2026-01-24T23:59:59"),
    storageKey: "obsidian_promo_dismissed",
    delayMs: 3000, // 3 seconds delay before showing popup
  };

  // Check if promotion is still valid
  function isPromoValid() {
    const now = new Date();
    return now <= PROMO_CONFIG.endDate;
  }

  // Check if gift period is active
  function isGiftPeriodActive() {
    const now = new Date();
    return now >= GIFT_CONFIG.startDate && now <= GIFT_CONFIG.endDate;
  }

  // Check if user has already dismissed the popup
  function hasUserDismissed() {
    return localStorage.getItem(PROMO_CONFIG.storageKey) === "true";
  }

  // Mark popup as dismissed
  function markAsDismissed() {
    localStorage.setItem(PROMO_CONFIG.storageKey, "true");
  }

  // Create popup HTML
  function createPopupHTML() {
    const popup = document.createElement("div");
    const currentPage =
      window.location.pathname.split("/").pop() || "index.html";
    const isDashboard = currentPage.includes("dashboard");
    const ctaLink = isDashboard
      ? "dashboard.html?section=subscription"
      : "register.html";

    popup.id = "promo-popup-overlay";
    popup.innerHTML = `
      <div class="promo-popup-overlay">
        <div class="promo-popup-container">
          <button class="promo-popup-close" aria-label="Close popup">
            <i class="fas fa-times"></i>
          </button>
          
          <div class="promo-popup-content">
            <div class="promo-popup-icon">
              <i class="fas fa-gift"></i>
            </div>
            
            <h2 class="promo-popup-title">Special Launch Offer!</h2>
            
            <div class="promo-popup-highlight">
              <span class="promo-popup-discount">100% OFF</span>
              <span class="promo-popup-subtitle">Your First Month</span>
            </div>
            
            <div class="promo-popup-code">
              <span class="promo-code-label">Use code:</span>
              <code class="promo-code-value">${PROMO_CONFIG.code}</code>
              <button class="promo-code-copy" data-code="${PROMO_CONFIG.code}" title="Copy code">
                <i class="fas fa-copy"></i>
              </button>
            </div>
            
            <div class="promo-popup-details">
              <p><i class="fas fa-check-circle"></i> Valid on Starter, Pro & Studio plans</p>
              <p><i class="fas fa-check-circle"></i> Cancel anytime, even during first month</p>
              <p><i class="fas fa-calendar-alt"></i> Offer valid until February 24, 2026</p>
            </div>
            
            <div class="promo-popup-actions promo-popup-actions-grid">
              <a href="${ctaLink}" class="btn-promo-primary">
                <i class="fas fa-rocket"></i> Get Started Now
              </a>
               <a href="gift.html" class="btn-promo-gift">
                <i class="fas fa-gift"></i> Shop Gift Cards
              </a>
              <button class="btn-promo-secondary promo-popup-dismiss">
                Got it!
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
    return popup;
  }

  // Create popup styles
  function createPopupStyles() {
    const style = document.createElement("style");
    style.textContent = `
      .promo-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(5px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        animation: fadeIn 0.3s ease-out;
        padding: 1rem;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }

      @keyframes slideUp {
        from {
          transform: translateY(30px);
          opacity: 0;
        }
        to {
          transform: translateY(0);
          opacity: 1;
        }
      }

      @keyframes fadeOut {
        from {
          opacity: 1;
        }
        to {
          opacity: 0;
        }
      }

      .promo-popup-container {
        background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
        border-radius: 20px;
        max-width: 500px;
        width: 100%;
        position: relative;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        border: 2px solid #b8605c;
        animation: slideUp 0.4s ease-out;
      }

      .promo-popup-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(184, 96, 92, 0.1);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #b8605c;
        font-size: 18px;
        transition: all 0.2s ease;
        z-index: 1;
      }

      .promo-popup-close:hover {
        background: rgba(184, 96, 92, 0.2);
        transform: rotate(90deg);
      }

      .promo-popup-content {
        padding: 40px 30px 30px;
        text-align: center;
      }

      .promo-popup-icon {
        font-size: 60px;
        color: #b8605c;
        margin-bottom: 20px;
        animation: bounce 1s ease-in-out infinite;
      }

      @keyframes bounce {
        0%, 100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-10px);
        }
      }

      .promo-popup-title {
        font-size: 28px;
        font-weight: bold;
        color: #1a1a1a;
        margin-bottom: 20px;
        line-height: 1.2;
      }

      .promo-popup-highlight {
        background: linear-gradient(135deg, #b8605c 0%, #d47a76 100%);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
      }

      .promo-popup-discount {
        display: block;
        font-size: 48px;
        font-weight: bold;
        color: #fff;
        line-height: 1;
        margin-bottom: 5px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      }

      .promo-popup-subtitle {
        display: block;
        font-size: 18px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
      }

      .promo-popup-code {
        background: #f5f5f5;
        border: 2px dashed #b8605c;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
      }

      .promo-code-label {
        color: #4a4a4a;
        font-size: 14px;
      }

      .promo-code-value {
        font-size: 24px;
        font-weight: bold;
        color: #b8605c;
        background: rgba(184, 96, 92, 0.1);
        padding: 8px 20px;
        border-radius: 8px;
        letter-spacing: 2px;
        font-family: 'Courier New', monospace;
      }

      .promo-code-copy {
        background: rgba(184, 96, 92, 0.2);
        border: 1px solid #b8605c;
        color: #b8605c;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .promo-code-copy:hover {
        background: #b8605c;
        color: #fff;
        transform: scale(1.1);
      }

      .promo-code-copy.copied {
        background: #4caf50;
        border-color: #4caf50;
        color: #fff;
      }

      .promo-popup-details {
        text-align: left;
        margin-bottom: 25px;
      }

      .promo-popup-details p {
        color: #1a1a1a;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: bold;
      }

      .promo-popup-details i {
        color: #b8605c;
        font-size: 16px;
        flex-shrink: 0;
      }

      .promo-popup-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
      }

      /* Grid layout when gift button is present */
      .promo-popup-actions-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
      }

      .promo-popup-actions-grid .btn-promo-secondary {
        grid-column: 1 / -1;
      }

      .btn-promo-primary {
        background: linear-gradient(135deg, #b8605c 0%, #8b4545 100%);
        color: white;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
      }

      .btn-promo-primary:hover {
        background: linear-gradient(135deg, #c97571 0%, #b8605c 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(184, 96, 92, 0.3);
        color: white;
      }

      .btn-promo-gift {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        color: white;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
      }

      .btn-promo-gift:hover {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(14, 165, 233, 0.3);
        color: white;
      }

      .btn-promo-secondary {
        background: #f5f5f5;
        color: #1a1a1a;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 16px;
        border: 1px solid #cccccc;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .btn-promo-secondary:hover {
        background: #ffffff;
        border-color: #b8605c;
        color: #b8605c;
        transform: translateY(-2px);
      }

      /* Responsive */
      @media (max-width: 576px) {
        .promo-popup-container {
          max-width: 95%;
          margin: 0 10px;
        }

        .promo-popup-content {
          padding: 35px 20px 25px;
        }

        .promo-popup-title {
          font-size: 24px;
        }

        .promo-popup-discount {
          font-size: 40px;
        }

        .promo-popup-subtitle {
          font-size: 16px;
        }

        .promo-code-value {
          font-size: 20px;
          padding: 6px 16px;
        }

        .promo-popup-details p {
          font-size: 13px;
        }

        .btn-promo-primary,
        .btn-promo-gift,
        .btn-promo-secondary {
          padding: 12px 20px;
          font-size: 15px;
        }

        /* Stack buttons on mobile */
        .promo-popup-actions-grid {
          grid-template-columns: 1fr;
        }

        .promo-popup-actions-grid .btn-promo-secondary {
          grid-column: 1;
        }
      }
    `;
    return style;
  }

  // Copy code to clipboard
  function copyToClipboard(text, button) {
    navigator.clipboard
      .writeText(text)
      .then(() => {
        const icon = button.querySelector("i");
        const originalClass = icon.className;

        // Change icon and add copied class
        icon.className = "fas fa-check";
        button.classList.add("copied");

        // Reset after 2 seconds
        setTimeout(() => {
          icon.className = originalClass;
          button.classList.remove("copied");
        }, 2000);
      })
      .catch((err) => {
        console.error("Failed to copy code:", err);
      });
  }

  // Close popup
  function closePopup() {
    const overlay = document.getElementById("promo-popup-overlay");
    if (overlay) {
      overlay.style.animation = "fadeOut 0.3s ease-out";
      setTimeout(() => {
        overlay.remove();
      }, 300);
    }
  }

  // Show popup
  function showPopup() {
    // Don't show if already dismissed or promo expired
    if (hasUserDismissed() || !isPromoValid()) {
      return;
    }

    // Create and inject styles
    const styles = createPopupStyles();
    document.head.appendChild(styles);

    // Create and inject popup
    const popup = createPopupHTML();
    document.body.appendChild(popup);

    // Add event listeners
    const closeButton = popup.querySelector(".promo-popup-close");
    const dismissButton = popup.querySelector(".promo-popup-dismiss");
    const copyButton = popup.querySelector(".promo-code-copy");
    const overlay = popup.querySelector(".promo-popup-overlay");

    // Close on close button
    closeButton.addEventListener("click", () => {
      markAsDismissed();
      closePopup();
    });

    // Close on dismiss button
    dismissButton.addEventListener("click", () => {
      markAsDismissed();
      closePopup();
    });

    // Copy code
    copyButton.addEventListener("click", () => {
      const code = copyButton.getAttribute("data-code");
      copyToClipboard(code, copyButton);
    });

    // Close on ESC key
    document.addEventListener("keydown", function escHandler(e) {
      if (e.key === "Escape") {
        markAsDismissed();
        closePopup();
        document.removeEventListener("keydown", escHandler);
      }
    });
  }

  // Initialize popup after delay
  function initPromoPopup() {
    // Wait for DOM to be ready
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () => {
        setTimeout(showPopup, PROMO_CONFIG.delayMs);
      });
    } else {
      setTimeout(showPopup, PROMO_CONFIG.delayMs);
    }
  }

  // Start the popup system
  initPromoPopup();
})();
