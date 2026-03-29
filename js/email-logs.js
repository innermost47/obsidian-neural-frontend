let currentEmailPage = 1;
let selectedEmails = new Set();

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

async function loadEmailLogs(page = 1) {
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
}

function displayEmailLogs(emails) {
  const tbody = document.getElementById("email-logs-tbody");

  if (!emails || emails.length === 0) {
    tbody.innerHTML =
      '<tr><td colspan="10" class="text-center py-4">No emails found</td></tr>';
    return;
  }

  tbody.innerHTML = emails
    .map(
      (email) => `
    <tr>
      <td>
        <input 
          type="checkbox" 
          class="email-checkbox" 
          data-email-id="${email.id}"
          ${email.status === "failed" ? "" : "disabled"}
          onchange="toggleEmailSelection(${email.id}, this.checked)"
        >
      </td>
      <td>${email.id}</td>
      <td>
        <small>${email.recipient_email}</small>
        ${
          email.user_id
            ? `<br><small class="text-muted">User ID: ${email.user_id}</small>`
            : ""
        }
      </td>
      <td><small>${truncate(email.subject, 40)}</small></td>
      <td>
        <span class="badge bg-secondary">${formatEmailType(
          email.email_type
        )}</span>
      </td>
      <td>
        <span class="badge bg-${getEmailStatusColor(email.status)}">
          ${email.status}
        </span>
      </td>
      <td>
        ${
          email.retry_count > 0
            ? `<span class="badge bg-warning">${email.retry_count}</span>`
            : "-"
        }
      </td>
      <td><small>${formatDateTime(email.created_at)}</small></td>
      <td><small>${
        email.sent_at ? formatDateTime(email.sent_at) : "-"
      }</small></td>
      <td>
        <button 
          class="btn btn-sm btn-outline-primary" 
          onclick="viewLogEmailDetail(${email.id})"
          title="View details"
        >
          <i class="fas fa-eye"></i>
        </button>
        ${
          email.status === "failed"
            ? `
          <button 
            class="btn btn-sm btn-outline-success" 
            onclick="retryEmail(${email.id})"
            title="Retry sending"
          >
            <i class="fas fa-redo"></i>
          </button>
        `
            : ""
        }
      </td>
    </tr>
  `
    )
    .join("");
}

function getEmailStatusColor(status) {
  const colors = {
    sent: "success",
    failed: "danger",
    pending: "warning",
    retrying: "info",
  };
  return colors[status] || "secondary";
}

function formatEmailType(type) {
  return type.replace(/_/g, " ").replace(/\b\w/g, (l) => l.toUpperCase());
}

function formatDateTime(dateString) {
  if (!dateString) return "-";
  const date = new Date(dateString);
  return date.toLocaleString("en-US", {
    year: "numeric",
    month: "short",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  });
}

function truncate(str, length) {
  return str.length > length ? str.substring(0, length) + "..." : str;
}

function updatePagination(currentPage, totalPages, totalItems) {
  document.getElementById(
    "email-logs-info"
  ).textContent = `Showing page ${currentPage} of ${totalPages} (${totalItems} total emails)`;

  const pagination = document.getElementById("email-logs-pagination");
  let html = "";

  html += `
    <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
      <a class="page-link" href="#" onclick="loadEmailLogs(${
        currentPage - 1
      }); return false;">
        <i class="fas fa-chevron-left"></i>
      </a>
    </li>
  `;

  for (let i = 1; i <= totalPages; i++) {
    if (
      i === 1 ||
      i === totalPages ||
      (i >= currentPage - 2 && i <= currentPage + 2)
    ) {
      html += `
        <li class="page-item ${i === currentPage ? "active" : ""}">
          <a class="page-link" href="#" onclick="loadEmailLogs(${i}); return false;">${i}</a>
        </li>
      `;
    } else if (i === currentPage - 3 || i === currentPage + 3) {
      html +=
        '<li class="page-item disabled"><span class="page-link">...</span></li>';
    }
  }

  html += `
    <li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
      <a class="page-link" href="#" onclick="loadEmailLogs(${
        currentPage + 1
      }); return false;">
        <i class="fas fa-chevron-right"></i>
      </a>
    </li>
  `;

  pagination.innerHTML = html;
}

function toggleEmailSelection(emailId, checked) {
  if (checked) {
    selectedEmails.add(emailId);
  } else {
    selectedEmails.delete(emailId);
  }
  updateRetryButton();
}

function toggleAllEmails(checkbox) {
  const checkboxes = document.querySelectorAll(
    ".email-checkbox:not(:disabled)"
  );
  checkboxes.forEach((cb) => {
    cb.checked = checkbox.checked;
    const emailId = parseInt(cb.dataset.emailId);
    if (checkbox.checked) {
      selectedEmails.add(emailId);
    } else {
      selectedEmails.delete(emailId);
    }
  });
  updateRetryButton();
}

function updateRetryButton() {
  const btn = document.getElementById("retry-failed-btn");
  if (selectedEmails.size > 0) {
    btn.textContent = `Retry Selected (${selectedEmails.size})`;
    btn.disabled = false;
  } else {
    btn.innerHTML = '<i class="fas fa-redo me-1"></i>Retry Failed';
    btn.disabled = false;
  }
}

async function retryEmail(emailId) {
  if (!confirm("Retry sending this email?")) return;

  try {
    const result = await API.retryEmails([emailId]);
    showNotification(result.message, "success");
    loadEmailLogs(currentEmailPage);
    loadEmailStats();
  } catch (error) {
    console.error("Error retrying email:", error);
    showNotification("Error retrying email", "danger");
  }
}

async function retryFailedEmails() {
  const emailIds = selectedEmails.size > 0 ? Array.from(selectedEmails) : null;

  if (!emailIds) {
    if (!confirm("Retry ALL failed emails? This may take a while.")) return;

    try {
      const data = await API.getFailedEmails(500);

      if (data.failed_emails.length === 0) {
        showNotification("No failed emails to retry", "info");
        return;
      }

      const failedIds = data.failed_emails.map((e) => e.id);
      await retryEmailBatch(failedIds);
    } catch (error) {
      console.error("Error getting failed emails:", error);
      showNotification("Error loading failed emails", "danger");
    }
  } else {
    if (!confirm(`Retry ${emailIds.length} selected email(s)?`)) return;
    await retryEmailBatch(emailIds);
  }
}

async function retryEmailBatch(emailIds) {
  try {
    const result = await API.retryEmails(emailIds);
    showNotification(result.message, "success");

    selectedEmails.clear();
    document.getElementById("select-all-emails").checked = false;

    loadEmailLogs(currentEmailPage);
    loadEmailStats();
  } catch (error) {
    console.error("Error retrying emails:", error);
    showNotification("Error retrying emails", "danger");
  }
}

async function viewLogEmailDetail(emailId) {
  const modal = new bootstrap.Modal(
    document.getElementById("emailLogDetailModal")
  );
  modal.show();

  try {
    const email = await API.getEmailDetail(emailId);

    document.getElementById("emailLogDetailBody").innerHTML = `
      <div class="row mb-3">
        <div class="col-md-6">
          <h6 class="text-muted">Email Information</h6>
          <table class="table table-sm">
            <tr><td><strong>ID:</strong></td><td>${email.id}</td></tr>
            <tr><td><strong>Recipient:</strong></td><td>${
              email.recipient_email
            }</td></tr>
            <tr><td><strong>Type:</strong></td><td>${formatEmailType(
              email.email_type
            )}</td></tr>
            <tr><td><strong>Status:</strong></td><td>
              <span class="badge bg-${getEmailStatusColor(email.status)}">${
      email.status
    }</span>
            </td></tr>
          </table>
        </div>
        <div class="col-md-6">
          <h6 class="text-muted">Timestamps</h6>
          <table class="table table-sm">
            <tr><td><strong>Created:</strong></td><td>${formatDateTime(
              email.created_at
            )}</td></tr>
            <tr><td><strong>Sent:</strong></td><td>${
              email.sent_at ? formatDateTime(email.sent_at) : "-"
            }</td></tr>
            <tr><td><strong>Last Retry:</strong></td><td>${
              email.last_retry_at ? formatDateTime(email.last_retry_at) : "-"
            }</td></tr>
            <tr><td><strong>Retry Count:</strong></td><td>${
              email.retry_count
            }</td></tr>
          </table>
        </div>
      </div>

      ${
        email.user_info
          ? `
        <div class="mb-3">
          <h6 class="text-muted">User Information</h6>
          <div class="alert alert-info">
            <strong>Email:</strong> ${email.user_info.email}<br>
            <strong>ID:</strong> ${email.user_info.id}<br>
            <strong>Tier:</strong> ${email.user_info.subscription_tier}
          </div>
        </div>
      `
          : ""
      }

      <div class="mb-3">
        <h6 class="text-muted">Subject</h6>
        <div class="alert alert-secondary">${email.subject}</div>
      </div>

      ${
        email.error_message
          ? `
        <div class="mb-3">
          <h6 class="text-muted text-danger">Error Message</h6>
          <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>${email.error_message}
          </div>
        </div>
      `
          : ""
      }

      <div class="mb-3">
        <h6 class="text-muted">Email Body</h6>
        <div class="p-3" style="background: #f8f9fa; border-radius: 8px; max-height: 400px; overflow-y: auto;">
          <pre style="white-space: pre-wrap; font-size: 0.9em;">${
            email.body
          }</pre>
        </div>
      </div>
    `;
  } catch (error) {
    console.error("Error loading email details:", error);
    document.getElementById("emailDetailBody").innerHTML = `
      <div class="alert alert-danger">Error loading email details</div>
    `;
  }
}

function initEmailLogsSection() {
  loadEmailStats();
  loadEmailLogs(1);
}
