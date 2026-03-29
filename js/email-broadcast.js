let tinyEditor = null;
let broadcastRecipients = 0;

function initializeTinyMCE() {
  const textarea = document.getElementById("email-body");
  if (!textarea) {
    console.error("Textarea #email-body not found");
    return;
  }

  if (tinymce.get("email-body")) {
    tinymce.get("email-body").remove();
  }

  setTimeout(() => {
    tinymce.init({
      selector: "#email-body",
      height: 400,
      menubar: false,
      plugins: [
        "advlist",
        "autolink",
        "lists",
        "link",
        "charmap",
        "searchreplace",
        "visualblocks",
        "code",
        "insertdatetime",
        "table",
        "help",
        "wordcount",
      ],
      toolbar:
        "undo redo | formatselect | " +
        "bold italic underline forecolor backcolor | alignleft aligncenter " +
        "alignright alignjustify | bullist numlist | " +
        "link | removeformat | help",
      content_style:
        'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
      placeholder: "Write your message here...",
      promotion: false,
      branding: false,
      setup: function (editor) {
        editor.on("init", function () {
          console.log("TinyMCE initialized successfully");
          tinyEditor = editor;
        });
      },
    });
  }, 100);
}

async function loadBroadcastRecipients() {
  try {
    const data = await API.getBroadcastRecipientsCount();
    broadcastRecipients = data.count;
    document.getElementById("broadcast-recipients-count").textContent =
      broadcastRecipients;
  } catch (error) {
    console.error("Error loading recipients:", error);
    showNotification("Error loading recipients count", "danger");
  }
}

function previewEmail() {
  const subject = document.getElementById("email-subject").value;
  const body = tinymce.get("email-body").getContent();
  const bodyText = tinymce
    .get("email-body")
    .getContent({ format: "text" })
    .trim();

  if (!subject.trim()) {
    showNotification("Please enter a subject", "warning");
    return;
  }

  if (bodyText.length === 0) {
    showNotification("Please enter a message", "warning");
    return;
  }

  const modalHTML = `
    <div class="modal fade" id="previewModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              <i class="fas fa-eye me-2"></i>Email Preview
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="alert alert-info mb-3">
              <i class="fas fa-info-circle me-2"></i>
              This email will be sent to <strong>${broadcastRecipients}</strong> recipient(s)
            </div>
            <div class="mb-3">
              <strong>Subject:</strong>
              <div class="p-2 bg-light rounded mt-1">${subject}</div>
            </div>
            <div>
              <strong>Message:</strong>
              <div class="p-3 bg-light rounded mt-1" style="min-height: 200px;">
                ${body}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  `;

  const existingModal = document.getElementById("previewModal");
  if (existingModal) {
    existingModal.remove();
  }

  document.body.insertAdjacentHTML("beforeend", modalHTML);
  const modal = new bootstrap.Modal(document.getElementById("previewModal"));
  modal.show();

  document
    .getElementById("previewModal")
    .addEventListener("hidden.bs.modal", function () {
      this.remove();
    });
}

function setupBroadcastForm() {
  const form = document.getElementById("broadcast-form");
  if (!form) return;

  const newForm = form.cloneNode(true);
  form.parentNode.replaceChild(newForm, form);

  newForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const subject = document.getElementById("email-subject").value;
    const body = tinymce.get("email-body").getContent();
    const bodyText = tinymce
      .get("email-body")
      .getContent({ format: "text" })
      .trim();

    if (!subject.trim()) {
      showNotification("Please enter a subject", "warning");
      return;
    }

    if (bodyText.length === 0) {
      showNotification("Please enter a message", "warning");
      return;
    }

    const confirmHTML = `
      <div class="modal fade" id="confirmSendModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
              <h5 class="modal-title">
                <i class="fas fa-exclamation-triangle me-2"></i>Confirm Send
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p class="mb-3">You are about to send this email to:</p>
              <div class="alert alert-warning">
                <i class="fas fa-users me-2"></i>
                <strong>${broadcastRecipients}</strong> recipient(s)
              </div>
              <p class="mb-0"><strong>Subject:</strong> ${subject}</p>
              <p class="text-muted small mb-3">This action cannot be undone.</p>
              <p class="mb-0">Are you sure you want to continue?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-warning" id="confirmSendBtn">
                <i class="fas fa-paper-plane me-2"></i>Yes, Send Now
              </button>
            </div>
          </div>
        </div>
      </div>
    `;

    const existingModal = document.getElementById("confirmSendModal");
    if (existingModal) {
      existingModal.remove();
    }

    document.body.insertAdjacentHTML("beforeend", confirmHTML);
    const modal = new bootstrap.Modal(
      document.getElementById("confirmSendModal")
    );
    modal.show();

    document
      .getElementById("confirmSendBtn")
      .addEventListener("click", async () => {
        const btn = document.getElementById("confirmSendBtn");
        const originalHTML = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';

        try {
          const result = await API.sendBroadcastEmail(subject, body);

          modal.hide();

          showNotification(
            `Email sent successfully to ${result.sent_count} recipient(s)!`,
            "success"
          );

          newForm.reset();
          tinymce.get("email-body").setContent("");

          await loadEmailHistory();
        } catch (error) {
          showNotification(
            `Failed to send email: ${error.detail || error.message}`,
            "danger"
          );
        } finally {
          btn.disabled = false;
          btn.innerHTML = originalHTML;
        }
      });

    document
      .getElementById("confirmSendModal")
      .addEventListener("hidden.bs.modal", function () {
        this.remove();
      });
  });
}

async function loadEmailHistory() {
  const tbody = document.getElementById("email-history-tbody");
  if (!tbody) return;

  try {
    const data = await API.getBroadcastHistory();
    const history = data.history;

    if (history.length === 0) {
      tbody.innerHTML =
        '<tr><td colspan="5" class="text-center">No emails sent yet</td></tr>';
      return;
    }

    tbody.innerHTML = history
      .map(
        (email) => `
      <tr>
        <td><small>${formatDate(email.sent_at)}</small></td>
        <td>${email.subject}</td>
        <td>${email.recipients_count}</td>
        <td>
          <span class="badge bg-success">
            <i class="fas fa-check me-1"></i>Sent
          </span>
        </td>
        <td>
          <button class="btn btn-sm btn-outline-primary" onclick="viewEmailDetail(${
            email.id
          })">
            <i class="fas fa-eye"></i>
          </button>
        </td>
      </tr>
    `
      )
      .join("");
  } catch (error) {
    console.error("Error loading email history:", error);
    tbody.innerHTML =
      '<tr><td colspan="5" class="text-center text-danger">Error loading history</td></tr>';
  }
}

async function viewEmailDetail(emailId) {
  try {
    const data = await API.getBroadcastDetail(emailId);
    const email = data.email;

    const modalHTML = `
      <div class="modal fade" id="emailDetailModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                <i class="fas fa-envelope me-2"></i>Email Details
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <strong>Sent:</strong> ${formatDate(email.sent_at)}
              </div>
              <div class="mb-3">
                <strong>Recipients:</strong> ${email.recipients_count}
              </div>
              <div class="mb-3">
                <strong>Subject:</strong>
                <div class="p-2 bg-light rounded mt-1">${email.subject}</div>
              </div>
              <div>
                <strong>Message:</strong>
                <div class="p-3 bg-light rounded mt-1" style="min-height: 200px;">
                  ${email.body}
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    `;

    const existingModal = document.getElementById("emailDetailModal");
    if (existingModal) {
      existingModal.remove();
    }

    document.body.insertAdjacentHTML("beforeend", modalHTML);
    const modal = new bootstrap.Modal(
      document.getElementById("emailDetailModal")
    );
    modal.show();

    document
      .getElementById("emailDetailModal")
      .addEventListener("hidden.bs.modal", function () {
        this.remove();
      });
  } catch (error) {
    console.error("Error loading email detail:", error);
    showNotification("Error loading email details", "danger");
  }
}

function initBroadcastSection() {
  console.log("Initializing broadcast section...");
  initializeTinyMCE();
  loadBroadcastRecipients();
  loadEmailHistory();
  setupBroadcastForm();
}
