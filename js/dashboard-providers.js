window.loadUsersForProviderSelect = async function () {
  try {
    const data = await API.getAdminUsers();
    const select = document.getElementById("provider-user-id");
    const cur = select.value;
    select.innerHTML =
      '<option value="" class="bg-black">— No user linked —</option>';
    data.users.forEach((u) => {
      const opt = document.createElement("option");
      opt.value = u.id;
      opt.textContent = `${u.email} (#${u.id})`;
      opt.className = "bg-black";
      select.appendChild(opt);
    });
    select.value = cur;
  } catch (e) {
    console.error("Failed to load users for provider select", e);
  }
};

window.addProvider = async function () {
  const nameEl = document.getElementById("provider-name-input");
  const urlEl = document.getElementById("provider-url");
  if (!nameEl || !urlEl) {
    showNotification("Form elements not found", "danger");
    return;
  }

  const name = nameEl.value.trim();
  const url = urlEl.value.trim();
  const stripe = document.getElementById("provider-stripe").value.trim();
  const userId = document.getElementById("provider-user-id").value;

  if (!name || !url) {
    showNotification("Name and URL are required", "danger");
    return;
  }

  try {
    const data = await API.addProvider(name, url, stripe, userId);
    showNotification(`Provider "${name}" added successfully`, "success");
    document.getElementById("provider-api-key-display").textContent =
      data.provider.api_key;
    document.getElementById("server-auth-key-display").textContent =
      data.provider.activation_token;
    document.getElementById("docker-command-display").textContent =
      data.provider.docker_command;
    document
      .getElementById("provider-api-key-alert")
      .classList.remove("hidden");
    nameEl.value = "";
    urlEl.value = "";
    document.getElementById("provider-stripe").value = "";
    document.getElementById("provider-user-id").value = "";
    loadProviders();
  } catch (error) {
    showNotification(error.detail || "Failed to add provider", "danger");
  }
};

window.copyKey = function (elementId) {
  const text = document.getElementById(elementId).textContent;
  navigator.clipboard
    .writeText(text)
    .then(() => showNotification("Key copied to clipboard", "success"))
    .catch(() => showNotification("Failed to copy key", "danger"));
};

window.loadProviders = async function () {
  try {
    const data = await API.listProviders();
    const providers = data.providers;
    document.getElementById("providers-count").textContent = providers.length;
    const tbody = document.getElementById("providers-tbody");

    if (!providers.length) {
      tbody.innerHTML =
        '<tr><td colspan="9" class="text-center py-8 text-gray-600">No providers yet</td></tr>';
      return;
    }

    tbody.innerHTML = providers
      .map(
        (p) => `
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-3 py-2.5 border-b border-white/[0.04] font-bold text-white">${p.name}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04]">
                    ${
                      p.is_online
                        ? `<span class="inline-flex items-center gap-1 bg-success/10 text-success border border-success/25 rounded-full px-2 py-0.5 text-[0.65rem] font-bold"><span class="w-1 h-1 rounded-full bg-success"></span>Online</span>`
                        : `<span class="inline-block bg-white/5 text-gray-500 border border-white/10 rounded-full px-2 py-0.5 text-[0.65rem] font-bold">Offline</span>`
                    }
                </td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-500 text-[0.7rem]">${p.user_email || "—"}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-500 font-mono text-[0.65rem]">${p.url}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04]">
                    ${
                      p.is_banned
                        ? `<span class="inline-block bg-danger/10 text-danger border border-danger/30 rounded-full px-2 py-0.5 text-[0.65rem] font-bold">Banned</span>`
                        : p.is_active
                          ? `<span class="inline-block bg-success/10 text-success border border-success/30 rounded-full px-2 py-0.5 text-[0.65rem] font-bold">Active</span>`
                          : `<span class="inline-block bg-white/10 text-gray-400 border border-white/10 rounded-full px-2 py-0.5 text-[0.65rem] font-bold">Inactive</span>`
                    }
                </td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 font-mono text-xs">${p.jobs_done_this_month ?? 0}<span class="text-gray-600">/${p.jobs_done ?? 0}</span></td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 text-xs">${p.uptime?.month_progress_pct != null ? p.uptime.month_progress_pct + "%" : "—"}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-500 text-[0.7rem]">${p.last_seen ? new Date(p.last_seen).toLocaleString() : "Never"}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04]">
                    <div class="flex items-center gap-1">
                        ${
                          p.stripe_account_id?.trim()
                            ? `<span class="inline-flex items-center gap-1 bg-success/10 text-success border border-success/30 rounded-full px-2 py-0.5 text-[0.65rem] font-bold"><i class="fas fa-check"></i>Stripe OK</span>`
                            : `<button onclick="sendOnboardingLink(${p.id}, '${p.name}')" class="px-2 py-1 rounded-lg bg-warning/10 border border-warning/30 text-warning font-bold text-xs hover:bg-warning/20 transition-colors"><i class="fas fa-link mr-1"></i>Stripe</button>`
                        }
                        <button onclick="deleteProvider(${p.id}, '${p.name}')" class="px-2 py-1 rounded-lg border border-danger/30 text-danger font-bold text-xs hover:bg-danger/10 transition-colors"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>`,
      )
      .join("");
  } catch (error) {
    showNotification("Failed to load providers", "danger");
  }
};

window.sendOnboardingLink = async function (id, name) {
  const btn = event.target.closest("button");
  const originalHTML = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Loading...';

  try {
    const data = await API.getProviderOnboardingLink(id);
    btn.disabled = false;
    btn.innerHTML = originalHTML;

    document.getElementById("onboardingModal")?.remove();
    const div = document.createElement("div");
    div.id = "onboardingModal";
    div.className =
      "fixed inset-0 z-[2000] flex items-center justify-center p-4";
    div.innerHTML = `
            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="document.getElementById('onboardingModal').remove()"></div>
            <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-md overflow-hidden">
                <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
                    <h5 class="font-bold text-white m-0"><i class="fas fa-link mr-2 text-primary"></i>Stripe Onboarding — ${name}</h5>
                    <button onclick="document.getElementById('onboardingModal').remove()" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-400 mb-4">Send this link to <strong class="text-white">${name}</strong> so they can connect their bank account on Stripe. The link expires after one use.</p>
                    <div class="flex gap-2 mb-4">
                        <input type="text" id="onboarding-url-input" value="${data.onboarding_url}" readonly class="flex-1 px-3 py-2 rounded-xl bg-white/5 border border-white/10 text-white font-mono text-xs focus:outline-none" />
                        <button onclick="copyOnboardingLink()" class="px-3 py-2 rounded-xl border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-copy"></i></button>
                    </div>
                    <a href="${data.onboarding_url}" target="_blank" class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl bg-warning/10 border border-warning/30 text-warning font-bold text-sm hover:bg-warning/20 transition-colors">
                        <i class="fas fa-external-link-alt"></i>Open link
                    </a>
                </div>
            </div>`;
    document.body.appendChild(div);
  } catch (error) {
    btn.disabled = false;
    btn.innerHTML = originalHTML;
    showNotification(
      error.detail || "Failed to generate onboarding link",
      "danger",
    );
  }
};

window.copyOnboardingLink = function () {
  navigator.clipboard.writeText(
    document.getElementById("onboarding-url-input").value,
  );
  showNotification("Onboarding link copied!", "success");
};

window.deleteProvider = async function (id, name) {
  if (!confirm(`Delete provider "${name}"?`)) return;
  try {
    await API.deleteProvider(id);
    showNotification(`Provider "${name}" deleted`, "success");
    loadProviders();
  } catch (error) {
    showNotification(error.detail || "Failed to delete provider", "danger");
  }
};
