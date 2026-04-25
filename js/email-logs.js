let currentEmailPage = 1;
let selectedEmails = new Set();

function getEmailStatusCls(status) {
  const map = {
    sent: "bg-success/10 border-success/30 text-success",
    failed: "bg-danger/10 border-danger/30 text-danger",
    pending: "bg-warning/10 border-warning/30 text-warning",
    retrying: "bg-primary/10 border-primary/30 text-primary",
  };
  return map[status] || "bg-white/10 border-white/20 text-gray-400";
}

function formatEmailType(type) {
  return type.replace(/_/g, " ").replace(/\b\w/g, (l) => l.toUpperCase());
}

function formatDateTime(dateString) {
  if (!dateString) return "—";
  return new Date(dateString).toLocaleString("en-US", {
    year: "numeric",
    month: "short",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  });
}

function truncate(str, length) {
  return str.length > length ? str.substring(0, length) + "…" : str;
}

async function loadEmailStats() {
  try {
    const stats = await API.getEmailStats(30);
    document.getElementById("email-stats-total").textContent =
      stats.total_emails;
    document.getElementById("email-stats-sent").textContent = stats.sent;
    document.getElementById("email-stats-failed").textContent = stats.failed;
    document.getElementById("email-stats-pending").textContent = stats.pending;
    document.getElementById("email-stats-rate").textContent =
      stats.success_rate;
  } catch (error) {
    console.error("Error loading email stats:", error);
    showNotification("Error loading email statistics", "danger");
  }
}

window.loadEmailLogs = async function (page = 1) {
  currentEmailPage = page;
  const status = document.getElementById("email-filter-status").value;
  const type = document.getElementById("email-filter-type").value;
  const search = document.getElementById("email-filter-search").value;

  try {
    const data = await API.getEmailLogs({
      page,
      limit: 50,
      status,
      email_type: type,
      search,
    });
    displayEmailLogs(data.emails);
    updatePagination(data.page, data.total_pages, data.total);
  } catch (error) {
    console.error("Error loading email logs:", error);
    showNotification("Error loading email logs", "danger");
  }
};

function displayEmailLogs(emails) {
  const tbody = document.getElementById("email-logs-tbody");
  if (!emails?.length) {
    tbody.innerHTML =
      '<tr><td colspan="10" class="text-center py-8 text-gray-600">No emails found</td></tr>';
    return;
  }

  tbody.innerHTML = emails
    .map(
      (email) => `
        <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="px-3 py-2.5 border-b border-white/[0.04]">
                <input type="checkbox" class="email-checkbox accent-primary cursor-pointer"
                    data-email-id="${email.id}"
                    ${email.status === "failed" ? "" : "disabled"}
                    onchange="toggleEmailSelection(${email.id}, this.checked)" />
            </td>
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-500 font-mono text-xs">${email.id}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">
                <div class="text-white text-xs">${email.recipient_email}</div>
                ${email.user_id ? `<div class="text-gray-600 text-[0.65rem]">User ID: ${email.user_id}</div>` : ""}
            </td>
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 text-xs">${truncate(email.subject, 40)}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">
                <span class="inline-block px-2 py-0.5 rounded-full border text-[0.65rem] font-bold bg-white/10 border-white/20 text-gray-400">${formatEmailType(email.email_type)}</span>
            </td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">
                <span class="inline-block px-2 py-0.5 rounded-full border text-[0.65rem] font-bold ${getEmailStatusCls(email.status)}">${email.status}</span>
            </td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">
                ${
                  email.retry_count > 0
                    ? `<span class="inline-block px-2 py-0.5 rounded-full border text-[0.65rem] font-bold bg-warning/10 border-warning/30 text-warning">${email.retry_count}</span>`
                    : '<span class="text-gray-600">—</span>'
                }
            </td>
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-500 text-[0.7rem]">${formatDateTime(email.created_at)}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-500 text-[0.7rem]">${email.sent_at ? formatDateTime(email.sent_at) : "—"}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">
                <div class="flex items-center gap-1">
                    <button onclick="viewLogEmailDetail(${email.id})" title="View details"
                        class="px-2 py-1 rounded-lg border border-white/20 text-white text-xs hover:bg-white/5 transition-colors">
                        <i class="fas fa-eye"></i>
                    </button>
                    ${
                      email.status === "failed"
                        ? `
                    <button onclick="retryEmail(${email.id})" title="Retry sending"
                        class="px-2 py-1 rounded-lg border border-success/30 text-success text-xs hover:bg-success/10 transition-colors">
                        <i class="fas fa-redo"></i>
                    </button>`
                        : ""
                    }
                </div>
            </td>
        </tr>`,
    )
    .join("");
}

function updatePagination(currentPage, totalPages, totalItems) {
  document.getElementById("email-logs-info").textContent =
    `Showing page ${currentPage} of ${totalPages} (${totalItems} total emails)`;

  const pagination = document.getElementById("email-logs-pagination");
  let html = "";

  const btnCls =
    "px-3 py-1.5 rounded-lg border text-xs font-bold transition-all";
  const activeCls =
    "bg-gradient-to-r from-primary to-[#a04840] border-transparent text-white";
  const normalCls =
    "border-white/20 text-gray-400 hover:border-primary/50 hover:text-white";
  const disabledCls = "border-white/10 text-gray-700 cursor-not-allowed";

  html += `<li><button onclick="loadEmailLogs(${currentPage - 1})" ${currentPage === 1 ? "disabled" : ""}
        class="${btnCls} ${currentPage === 1 ? disabledCls : normalCls}">
        <i class="fas fa-chevron-left"></i></button></li>`;

  for (let i = 1; i <= totalPages; i++) {
    if (
      i === 1 ||
      i === totalPages ||
      (i >= currentPage - 2 && i <= currentPage + 2)
    ) {
      html += `<li><button onclick="loadEmailLogs(${i})"
                class="${btnCls} ${i === currentPage ? activeCls : normalCls}">${i}</button></li>`;
    } else if (i === currentPage - 3 || i === currentPage + 3) {
      html += `<li><span class="px-2 text-gray-600 text-xs">…</span></li>`;
    }
  }

  html += `<li><button onclick="loadEmailLogs(${currentPage + 1})" ${currentPage === totalPages ? "disabled" : ""}
        class="${btnCls} ${currentPage === totalPages ? disabledCls : normalCls}">
        <i class="fas fa-chevron-right"></i></button></li>`;

  pagination.innerHTML = html;
}

window.toggleEmailSelection = function (emailId, checked) {
  checked ? selectedEmails.add(emailId) : selectedEmails.delete(emailId);
  updateRetryButton();
};

window.toggleAllEmails = function (checkbox) {
  document.querySelectorAll(".email-checkbox:not(:disabled)").forEach((cb) => {
    cb.checked = checkbox.checked;
    const id = parseInt(cb.dataset.emailId);
    checkbox.checked ? selectedEmails.add(id) : selectedEmails.delete(id);
  });
  updateRetryButton();
};

function updateRetryButton() {
  const btn = document.getElementById("retry-failed-btn");
  btn.innerHTML =
    selectedEmails.size > 0
      ? `<i class="fas fa-redo mr-1"></i>Retry Selected (${selectedEmails.size})`
      : '<i class="fas fa-redo mr-1"></i>Retry Failed';
}

window.retryEmail = async function (emailId) {
  if (!confirm("Retry sending this email?")) return;
  try {
    const result = await API.retryEmails([emailId]);
    showNotification(result.message, "success");
    loadEmailLogs(currentEmailPage);
    loadEmailStats();
  } catch (error) {
    showNotification("Error retrying email", "danger");
  }
};

window.retryFailedEmails = async function () {
  const emailIds = selectedEmails.size > 0 ? Array.from(selectedEmails) : null;

  if (!emailIds) {
    if (!confirm("Retry ALL failed emails? This may take a while.")) return;
    try {
      const data = await API.getFailedEmails(500);
      if (!data.failed_emails.length) {
        showNotification("No failed emails to retry", "info");
        return;
      }
      await retryEmailBatch(data.failed_emails.map((e) => e.id));
    } catch (error) {
      showNotification("Error loading failed emails", "danger");
    }
  } else {
    if (!confirm(`Retry ${emailIds.length} selected email(s)?`)) return;
    await retryEmailBatch(emailIds);
  }
};

async function retryEmailBatch(emailIds) {
  try {
    const result = await API.retryEmails(emailIds);
    showNotification(result.message, "success");
    selectedEmails.clear();
    document.getElementById("select-all-emails").checked = false;
    loadEmailLogs(currentEmailPage);
    loadEmailStats();
  } catch (error) {
    showNotification("Error retrying emails", "danger");
  }
}

window.viewLogEmailDetail = async function (emailId) {
  const modal = document.getElementById("emailLogDetailModal");
  const body = document.getElementById("emailLogDetailBody");
  modal?.classList.remove("hidden");
  body.innerHTML =
    '<div class="text-center py-10 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></div>';

  try {
    const email = await API.getEmailDetail(emailId);

    body.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Email Information</h6>
                    <div class="space-y-2 text-sm">
                        <div class="flex gap-2"><span class="text-gray-500 w-20 shrink-0">ID</span><span class="text-gray-300 font-mono">${email.id}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-20 shrink-0">Recipient</span><span class="text-white break-all">${email.recipient_email}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-20 shrink-0">Type</span><span class="text-gray-300">${formatEmailType(email.email_type)}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-20 shrink-0">Status</span><span class="inline-block px-2 py-0.5 rounded-full border text-[0.65rem] font-bold ${getEmailStatusCls(email.status)}">${email.status}</span></div>
                    </div>
                </div>
                <div>
                    <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Timestamps</h6>
                    <div class="space-y-2 text-sm">
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Created</span><span class="text-gray-300 text-xs">${formatDateTime(email.created_at)}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Sent</span><span class="text-gray-300 text-xs">${email.sent_at ? formatDateTime(email.sent_at) : "—"}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Last Retry</span><span class="text-gray-300 text-xs">${email.last_retry_at ? formatDateTime(email.last_retry_at) : "—"}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Retry Count</span><span class="text-gray-300">${email.retry_count}</span></div>
                    </div>
                </div>
            </div>

            ${
              email.user_info
                ? `
            <div class="bg-primary/10 border border-primary/30 rounded-xl p-4 mb-4 text-sm">
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">User Information</h6>
                <div class="space-y-1 text-gray-300">
                    <div><strong class="text-white">Email:</strong> ${email.user_info.email}</div>
                    <div><strong class="text-white">ID:</strong> ${email.user_info.id}</div>
                    <div><strong class="text-white">Tier:</strong> ${email.user_info.subscription_tier}</div>
                </div>
            </div>`
                : ""
            }

            <div class="mb-4">
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Subject</h6>
                <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3 text-white text-sm">${email.subject}</div>
            </div>

            ${
              email.error_message
                ? `
            <div class="mb-4">
                <h6 class="text-xs font-bold text-danger uppercase tracking-wider mb-2">Error Message</h6>
                <div class="bg-danger/10 border border-danger/30 rounded-xl px-4 py-3 text-danger text-sm">
                    <i class="fas fa-exclamation-triangle mr-2"></i>${email.error_message}
                </div>
            </div>`
                : ""
            }

            <div>
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email Body</h6>
                <div class="bg-black/30 border border-white/10 rounded-xl p-4 max-h-[400px] overflow-y-auto">
                    <pre class="text-gray-300 text-xs whitespace-pre-wrap">${email.body}</pre>
                </div>
            </div>`;
  } catch (error) {
    console.error("Error loading email details:", error);
    body.innerHTML =
      '<div class="bg-danger/10 border border-danger/30 rounded-xl p-4 text-danger text-sm">Error loading email details</div>';
  }
};

window.initEmailLogsSection = function () {
  loadEmailStats();
  loadEmailLogs(1);
};
