let tinyEditor = null;
let broadcastRecipients = 0;

function injectModal(id, html) {
  document.getElementById(id)?.remove();
  document.body.insertAdjacentHTML("beforeend", html);
}
function closeInjectModal(id) {
  document.getElementById(id)?.remove();
}

function initializeTinyMCE() {
  const textarea = document.getElementById("email-body");
  if (!textarea) {
    console.error("Textarea #email-body not found");
    return;
  }
  if (tinymce.get("email-body")) tinymce.get("email-body").remove();

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
        "undo redo | formatselect | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link | removeformat | help",
      content_style:
        'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; background:#0a0a0c; color:#fff; }',
      placeholder: "Write your message here...",
      promotion: false,
      branding: false,
      skin: "oxide-dark",
      content_css: "dark",
      setup: function (editor) {
        editor.on("init", function () {
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

window.previewEmail = function () {
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
  if (!bodyText.length) {
    showNotification("Please enter a message", "warning");
    return;
  }

  injectModal(
    "previewModal",
    `
        <div id="previewModal" class="fixed inset-0 z-[2000] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeInjectModal('previewModal')"></div>
            <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">
                <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
                    <h5 class="font-bold text-white m-0"><i class="fas fa-eye mr-2 text-primary"></i>Email Preview</h5>
                    <button onclick="closeInjectModal('previewModal')" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6 overflow-y-auto flex-1">
                    <div class="bg-primary/10 border border-primary/30 rounded-xl p-3 mb-4 text-sm text-primary">
                        <i class="fas fa-info-circle mr-2"></i>This email will be sent to <strong>${broadcastRecipients}</strong> recipient(s)
                    </div>
                    <div class="mb-4">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Subject</p>
                        <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3 text-white text-sm">${subject}</div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Message</p>
                        <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4 text-gray-300 text-sm min-h-[200px]">${body}</div>
                    </div>
                </div>
                <div class="px-6 pb-6 flex justify-end">
                    <button onclick="closeInjectModal('previewModal')" class="px-5 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors">Close</button>
                </div>
            </div>
        </div>`,
  );
};

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
    if (!bodyText.length) {
      showNotification("Please enter a message", "warning");
      return;
    }

    injectModal(
      "confirmSendModal",
      `
            <div id="confirmSendModal" class="fixed inset-0 z-[2000] flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeInjectModal('confirmSendModal')"></div>
                <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-warning/30 bg-warning/10 flex items-center justify-between">
                        <h5 class="font-bold text-warning m-0"><i class="fas fa-exclamation-triangle mr-2"></i>Confirm Send</h5>
                        <button onclick="closeInjectModal('confirmSendModal')" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-400 mb-3">You are about to send this email to:</p>
                        <div class="bg-warning/10 border border-warning/30 rounded-xl p-3 mb-3 text-warning text-sm font-medium">
                            <i class="fas fa-users mr-2"></i><strong>${broadcastRecipients}</strong> recipient(s)
                        </div>
                        <p class="text-sm text-white mb-1"><strong>Subject:</strong> ${subject}</p>
                        <p class="text-xs text-gray-500 mb-3">This action cannot be undone.</p>
                        <p class="text-sm text-gray-400">Are you sure you want to continue?</p>
                    </div>
                    <div class="px-6 pb-6 flex justify-end gap-3">
                        <button onclick="closeInjectModal('confirmSendModal')" class="px-5 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors">Cancel</button>
                        <button id="confirmSendBtn" class="px-5 py-2.5 rounded-xl bg-warning/10 border border-warning/30 text-warning font-bold text-sm hover:bg-warning/20 transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i>Yes, Send Now
                        </button>
                    </div>
                </div>
            </div>`,
    );

    document
      .getElementById("confirmSendBtn")
      .addEventListener("click", async () => {
        const btn = document.getElementById("confirmSendBtn");
        const originalHTML = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';

        try {
          const result = await API.sendBroadcastEmail(subject, body);
          closeInjectModal("confirmSendModal");
          showNotification(
            `Email sent successfully to ${result.sent_count} recipient(s)!`,
            "success",
          );
          newForm.reset();
          tinymce.get("email-body").setContent("");
          await loadEmailHistory();
        } catch (error) {
          showNotification(
            `Failed to send email: ${error.detail || error.message}`,
            "danger",
          );
        } finally {
          btn.disabled = false;
          btn.innerHTML = originalHTML;
        }
      });
  });
}

async function loadEmailHistory() {
  const tbody = document.getElementById("email-history-tbody");
  if (!tbody) return;

  try {
    const data = await API.getBroadcastHistory();
    const history = data.history;

    if (!history.length) {
      tbody.innerHTML =
        '<tr><td colspan="5" class="text-center py-8 text-gray-600">No emails sent yet</td></tr>';
      return;
    }

    tbody.innerHTML = history
      .map(
        (email) => `
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-500 text-xs">${formatDate(email.sent_at)}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-white text-sm">${email.subject}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 text-xs">${email.recipients_count}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04]">
                    <span class="inline-flex items-center gap-1 bg-success/10 text-success border border-success/30 rounded-full px-2 py-0.5 text-[0.65rem] font-bold">
                        <i class="fas fa-check"></i>Sent
                    </span>
                </td>
                <td class="px-3 py-2.5 border-b border-white/[0.04]">
                    <button onclick="viewEmailDetail(${email.id})" class="px-2 py-1 rounded-lg border border-white/20 text-white text-xs hover:bg-white/5 transition-colors">
                        <i class="fas fa-eye"></i>
                    </button>
                </td>
            </tr>`,
      )
      .join("");
  } catch (error) {
    console.error("Error loading email history:", error);
    tbody.innerHTML =
      '<tr><td colspan="5" class="text-center py-6 text-danger">Error loading history</td></tr>';
  }
}

window.viewEmailDetail = async function (emailId) {
  try {
    const data = await API.getBroadcastDetail(emailId);
    const email = data.email;

    injectModal(
      "emailDetailModal",
      `
            <div id="emailDetailModal" class="fixed inset-0 z-[2000] flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeInjectModal('emailDetailModal')"></div>
                <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">
                    <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
                        <h5 class="font-bold text-white m-0"><i class="fas fa-envelope mr-2 text-primary"></i>Email Details</h5>
                        <button onclick="closeInjectModal('emailDetailModal')" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="p-6 overflow-y-auto flex-1 space-y-4">
                        <div class="flex gap-4 text-sm">
                            <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3 flex-1">
                                <p class="text-xs text-gray-500 mb-1">Sent</p>
                                <p class="text-white font-bold">${formatDate(email.sent_at)}</p>
                            </div>
                            <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3 flex-1">
                                <p class="text-xs text-gray-500 mb-1">Recipients</p>
                                <p class="text-white font-bold">${email.recipients_count}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Subject</p>
                            <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3 text-white text-sm">${email.subject}</div>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Message</p>
                            <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4 text-gray-300 text-sm min-h-[200px]">${email.body}</div>
                        </div>
                    </div>
                    <div class="px-6 pb-6 flex justify-end">
                        <button onclick="closeInjectModal('emailDetailModal')" class="px-5 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors">Close</button>
                    </div>
                </div>
            </div>`,
    );
  } catch (error) {
    console.error("Error loading email detail:", error);
    showNotification("Error loading email details", "danger");
  }
};

window.initBroadcastSection = function () {
  initializeTinyMCE();
  loadBroadcastRecipients();
  loadEmailHistory();
  setupBroadcastForm();
};
