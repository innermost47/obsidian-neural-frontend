let allUsers = [];

function tierBadge(tier) {
  const map = {
    free: "bg-white/10 text-gray-400",
    starter: "bg-primary/10 text-primary",
    pro: "bg-primary/20 text-primary",
    studio: "bg-success/10 text-success",
  };
  return `<span class="inline-block px-2 py-0.5 rounded-full text-[0.65rem] font-bold border border-white/10 ${map[tier] || map.free}">${tier || "free"}</span>`;
}
function subStatusBadge(status) {
  const map = {
    active: "bg-success/10 text-success",
    canceling: "bg-warning/10 text-warning",
    canceled: "bg-danger/10 text-danger",
  };
  return `<span class="inline-block px-2 py-0.5 rounded-full text-[0.65rem] font-bold border border-white/10 ${map[status] || "bg-white/10 text-gray-400"}">${status || "inactive"}</span>`;
}
function yesNoBadge(v) {
  return v
    ? `<span class="inline-block px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-success/10 text-success border border-white/10">Yes</span>`
    : `<span class="inline-block px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-white/10 text-gray-400 border border-white/10">No</span>`;
}
function formatDate(d) {
  if (!d) return "—";
  return new Date(d).toLocaleDateString("en-US", {
    year: "numeric",
    month: "short",
    day: "numeric",
  });
}

window.loadAdminData = async function () {
  try {
    if (!userData?.is_admin) return;
    const [stats, usersData] = await Promise.all([
      API.getAdminStats(),
      API.getAdminUsers(),
    ]);
    document.getElementById("stat-total-users").textContent = stats.total_users;
    document.getElementById("stat-verified").textContent = stats.verified_users;
    document.getElementById("stat-paid").textContent = stats.paid_users;
    document.getElementById("stat-generations").textContent =
      stats.total_generations;
    allUsers = usersData.users;
    displayUsers(allUsers);
    document.getElementById("user-count").textContent = allUsers.length;
  } catch (error) {
    console.error("Error loading admin data:", error);
    showNotification("Error loading admin data", "danger");
  }
};

window.displayUsers = function (users) {
  const tbody = document.getElementById("usersTableBody");
  if (!tbody) return;
  if (!users.length) {
    tbody.innerHTML =
      '<tr><td colspan="9" class="text-center py-8 text-gray-600">No users found</td></tr>';
    return;
  }
  tbody.innerHTML = users
    .map(
      (u) => `
        <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400">${u.id}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-white">
                ${u.email}
                ${u.oauth_provider ? `<i class="fab fa-${u.oauth_provider} text-gray-500 ml-1 text-xs"></i>` : ""}
                ${u.email_verified ? `<i class="fas fa-check-circle text-success ml-1 text-xs"></i>` : ""}
                ${u.two_factor_enabled ? `<i class="fas fa-shield-alt text-primary ml-1 text-xs"></i>` : ""}
                ${u.is_admin ? `<i class="fas fa-crown text-warning ml-1 text-xs"></i>` : ""}
            </td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">${tierBadge(u.subscription_tier)}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">${subStatusBadge(u.subscription_status)}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 font-mono">${u.credits_remaining}/${u.credits_total} <span class="text-gray-600 text-[0.6rem]">(${u.credits_used} used)</span></td>
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400">${u.total_generations}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">${yesNoBadge(u.accept_news_updates)}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-500 text-[0.7rem]">${formatDate(u.created_at)}</td>
            <td class="px-3 py-2.5 border-b border-white/[0.04]">
                <button onclick="viewUserDetail(${u.id})" class="px-2 py-1 rounded-lg border border-white/20 text-white text-xs hover:bg-white/5 transition-colors"><i class="fas fa-eye"></i></button>
            </td>
        </tr>
    `,
    )
    .join("");
};

window.viewUserDetail = async function (userId) {
  openModal("userDetailModal");
  document.getElementById("userDetailBody").innerHTML =
    '<div class="text-center py-10 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></div>';
  try {
    const data = await API.getAdminUser(userId);
    const u = data.user;
    document.getElementById("userDetailBody").innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Account Information</h6>
                    <div class="space-y-2 text-sm">
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Email</span><span class="text-white">${u.email}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">ID</span><span class="text-gray-300 font-mono">${u.id}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Created</span><span class="text-gray-300">${formatDate(u.created_at)}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Last Login</span><span class="text-gray-300">${formatDate(u.last_login) || "Never"}</span></div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">OAuth</span><span class="text-gray-300">${u.oauth_provider || "None"}</span></div>
                    </div>
                </div>
                <div>
                    <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Subscription</h6>
                    <div class="space-y-2 text-sm">
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Tier</span>${tierBadge(u.subscription_tier)}</div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Status</span>${subStatusBadge(u.subscription_status)}</div>
                        <div class="flex gap-2"><span class="text-gray-500 w-24 shrink-0">Stripe ID</span><span class="text-gray-400 font-mono text-xs">${u.stripe_customer_id || "—"}</span></div>
                    </div>
                </div>
            </div>
            <div class="bg-primary/10 border border-primary/30 rounded-xl p-4 mb-5 text-sm">
                <strong class="text-white">Credits:</strong> <span class="text-primary font-bold">${u.credits_remaining} / ${u.credits_total}</span> <span class="text-gray-500">(${u.credits_used} used)</span><br>
                <strong class="text-white">Total Generations:</strong> <span class="text-gray-300">${data.total_generations}</span>
            </div>
            ${
              data.recent_generations?.length
                ? `
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Recent Generations</h6>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs border-separate border-spacing-0">
                        <thead><tr>${["Date", "Prompt", "BPM", "Credits"].map((h) => `<th class="px-3 py-2 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]">${h}</th>`).join("")}</tr></thead>
                        <tbody>${data.recent_generations.map((g) => `<tr class="hover:bg-white/[0.02]"><td class="px-3 py-2 border-b border-white/[0.04] text-gray-500">${formatDate(g.created_at)}</td><td class="px-3 py-2 border-b border-white/[0.04] text-gray-400">${g.prompt.substring(0, 50)}...</td><td class="px-3 py-2 border-b border-white/[0.04] text-gray-400">${g.bpm}</td><td class="px-3 py-2 border-b border-white/[0.04] text-gray-400">${g.credits_cost}</td></tr>`).join("")}</tbody>
                    </table>
                </div>`
                : ""
            }
        `;
  } catch (error) {
    document.getElementById("userDetailBody").innerHTML =
      '<div class="bg-danger/10 border border-danger/30 rounded-xl p-4 text-danger text-sm">Error loading user details</div>';
  }
};

window.loadProviderStats = async function () {
  try {
    const data = await API.getProviderStats();
    renderProviderStats(data);
    loadFinancesHistory(data.revenue.finances_url);
  } catch (error) {
    if (error.status === 404) {
      document.getElementById("section-provider-stats").innerHTML = `
                <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
                    <h1 class="text-xl font-extrabold text-white m-0"><i class="fas fa-server mr-3 text-primary"></i>My Provider Dashboard</h1>
                </div>
                <div class="p-6 lg:p-12">
                    <div class="bg-warning/10 border border-warning/30 rounded-xl p-4 text-warning text-sm">
                        No provider account is linked to your user yet. Contact the admin to get set up.
                    </div>
                </div>`;
    } else {
      showNotification("Failed to load provider stats", "danger");
    }
  }
};

function renderProviderStats(data) {
  const { provider, uptime, network, users, revenue, period } = data;

  const onlineEl = document.getElementById("provider-online-indicator");
  onlineEl.innerHTML = uptime.is_online
    ? `<span class="inline-flex items-center gap-1 ml-2 bg-success/10 text-success border border-success/25 rounded-full px-2 py-0.5 text-[0.65rem] font-bold"><span class="w-1.5 h-1.5 rounded-full bg-success" style="box-shadow:0 0 4px #28c840"></span>Online</span>`
    : `<span class="inline-flex items-center gap-1 ml-2 bg-white/5 text-gray-500 border border-white/10 rounded-full px-2 py-0.5 text-[0.65rem] font-bold opacity-70">Offline</span>`;

  document.getElementById("provider-name").textContent = provider.name;
  document.getElementById("provider-last-seen").textContent = provider.last_seen
    ? new Date(provider.last_seen).toLocaleString()
    : "Never";

  const hours24 = uptime.last_24h_hours;
  const target24 = uptime.last_24h_target;
  const uptimeEl = document.getElementById("provider-uptime");
  uptimeEl.textContent = `${hours24}h / ${target24}h today`;
  uptimeEl.className = `font-bold ${hours24 >= target24 ? "text-success" : "text-danger"}`;

  const badge = document.getElementById("provider-status-badge");
  badge.textContent = provider.is_active ? "Active" : "Inactive";
  badge.className = `px-3 py-1 rounded-full text-xs font-bold border ${provider.is_active ? "bg-success/10 border-success/30 text-success" : "bg-white/10 border-white/20 text-gray-400"}`;

  document.getElementById("provider-uptime-month").textContent =
    `${uptime.month_hours}h`;

  const daysPresent = uptime.days_present ?? 0;
  const daysRequired = uptime.days_required ?? 1;
  const daysPercent = Math.round((daysPresent / daysRequired) * 100);

  document.getElementById("stat-days-present").textContent = daysPresent;
  document.getElementById("stat-total-days-month").textContent = daysRequired;

  const daysPercentEl = document.getElementById("stat-days-percent");
  daysPercentEl.textContent = `${daysPercent}%`;

  const daysBar = document.getElementById("days-present-bar");
  daysBar.style.width = `${Math.min(daysPercent, 100)}%`;

  if (daysPercent >= 80) {
    daysBar.classList.add("bg-success");
    daysBar.classList.remove("bg-danger");
    daysPercentEl.classList.add("text-success");
    daysPercentEl.classList.remove("text-danger");
  } else {
    daysBar.classList.add("bg-danger");
    daysBar.classList.remove("bg-success");
    daysPercentEl.classList.add("text-danger");
    daysPercentEl.classList.remove("text-success");
  }

  document.getElementById("stat-my-jobs-month").textContent = (
    provider.jobs_done_this_month ?? 0
  ).toLocaleString();
  document.getElementById("stat-my-jobs-total").textContent =
    `${provider.jobs_done.toLocaleString()} total`;
  document.getElementById("stat-global-generations").textContent =
    network.global_generations_this_month.toLocaleString();
  document.getElementById("stat-active-providers").textContent =
    network.active_providers;
  document.getElementById("stat-paying-users").textContent =
    users.paying_total.toLocaleString();

  document.getElementById("rev-platform").textContent =
    `€${revenue.platform_monthly_eur.toFixed(2)}`;
  document.getElementById("rev-pool").textContent =
    `€${revenue.providers_pool_eur.toFixed(2)}`;
  document.getElementById("rev-my-share").textContent =
    `€${revenue.my_estimated_share_eur.toFixed(2)}`;

  const tierColors = {
    free: "bg-white/10 text-gray-400",
    starter: "bg-primary/10 text-primary",
    pro: "bg-primary/20 text-primary",
    studio: "bg-success/10 text-success",
  };
  const tierLabels = {
    free: "Free",
    starter: "Starter",
    pro: "Pro",
    studio: "Studio",
  };
  const totalUsers = Object.values(users.by_tier).reduce((a, b) => a + b, 0);
  document.getElementById("users-by-tier").innerHTML = Object.entries(
    users.by_tier,
  )
    .map(([tier, count]) => {
      const pct = totalUsers > 0 ? ((count / totalUsers) * 100).toFixed(0) : 0;
      const cls = tierColors[tier] || tierColors.free;
      const label = tierLabels[tier] || tier;
      return `
            <div class="flex items-center gap-2">
                <span class="inline-block w-16 text-center px-2 py-0.5 rounded-full text-[0.65rem] font-bold border border-white/10 ${cls} shrink-0">${label}</span>
                <div class="flex-1 h-2 bg-white/5 rounded-full overflow-hidden"><div class="h-full ${cls.includes("success") ? "bg-success" : "bg-primary"} rounded-full" style="width:${pct}%"></div></div>
                <span class="font-bold text-white text-xs w-6 text-right shrink-0">${count}</span>
                <span class="text-gray-600 text-xs w-8 shrink-0">${pct}%</span>
            </div>`;
    })
    .join("");
}

window.loadFinancesHistory = async function (financesUrl) {
  const tbody = document.getElementById("finances-history-tbody");
  if (!financesUrl) {
    tbody.innerHTML =
      '<tr><td colspan="5" class="text-center py-6 text-gray-600">No data available</td></tr>';
    return;
  }
  try {
    const res = await fetch(financesUrl);
    const data = await res.json();
    const history = data.history || [];
    if (!history.length) {
      tbody.innerHTML =
        '<tr><td colspan="5" class="text-center py-6 text-gray-600">No history yet</td></tr>';
      return;
    }
    tbody.innerHTML = history
      .map((row) => {
        const pool = (row.platform_revenue_eur * 0.85).toFixed(2);
        const perProv =
          row.active_providers > 0
            ? (
                (row.platform_revenue_eur * 0.85) /
                row.active_providers
              ).toFixed(2)
            : "—";
        return `<tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-3 py-2.5 border-b border-white/[0.04] font-bold text-white">${row.period}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400">€${row.platform_revenue_eur.toFixed(2)}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400">€${pool}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400">${row.active_providers ?? "—"}</td>
                <td class="px-3 py-2.5 border-b border-white/[0.04] font-bold text-primary">€${perProv}</td>
            </tr>`;
      })
      .join("");
  } catch {
    tbody.innerHTML =
      '<tr><td colspan="5" class="text-center py-6 text-gray-600">Could not load history</td></tr>';
  }
};
