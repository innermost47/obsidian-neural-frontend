(function () {
  const API_URL = window.APP_CONFIG?.API_URL || "http://localhost:8000/api/v1";
  const GITHUB_URL = window.APP_CONFIG?.GITHUB_URL || "#";
  const el = (id) => document.getElementById(id);

  const ghLink = el("footer-github-link");
  if (ghLink) ghLink.href = GITHUB_URL;

  function fmt(n, dec = 2) {
    if (n == null) return "—";
    return Number(n).toLocaleString("en-US", {
      minimumFractionDigits: dec,
      maximumFractionDigits: dec,
    });
  }
  function fmtDate(iso) {
    if (!iso) return "—";
    return new Date(iso).toLocaleString("en-GB", {
      day: "2-digit",
      month: "short",
      year: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    });
  }
  function shortDate(iso) {
    if (!iso) return "—";
    return new Date(iso).toLocaleString("en-GB", {
      day: "2-digit",
      month: "short",
      year: "numeric",
    });
  }
  function emptyState(icon, msg) {
    return `<div class="text-center py-12 text-gray-600"><i class="fas ${icon} text-2xl mb-3 block opacity-30"></i>${msg}</div>`;
  }

  window.switchPanel = function (btn) {
    document.querySelectorAll(".section-tab").forEach((b) => {
      b.classList.remove(
        "bg-gradient-to-r",
        "from-primary",
        "to-[#a04840]",
        "border-transparent",
        "text-white",
      );
      b.classList.add(
        "border-white/10",
        "text-gray-400",
        "bg-white/[0.03]",
        "hover:border-primary/50",
        "hover:text-white",
      );
    });
    document.querySelectorAll(".data-panel").forEach((p) => {
      p.classList.add("hidden");
      p.classList.remove("block");
    });
    btn.classList.add(
      "bg-gradient-to-r",
      "from-primary",
      "to-[#a04840]",
      "border-transparent",
      "text-white",
    );
    btn.classList.remove(
      "border-white/10",
      "text-gray-400",
      "bg-white/[0.03]",
      "hover:border-primary/50",
      "hover:text-white",
    );
    const panel = el(btn.dataset.panel);
    if (panel) {
      panel.classList.remove("hidden");
      panel.classList.add("block");
    }
  };

  async function loadPublicStats() {
    try {
      const r = await fetch(`${API_URL}/public/stats`);
      const d = await r.json();
      el("stat-paying").textContent = (d.paying_users ?? 0).toLocaleString();
      el("stat-updated").textContent = shortDate(d.updated_at);
    } catch {
      el("stat-paying").textContent = "—";
      el("stat-updated").textContent = "—";
    }
  }

  let ownPage = 1,
    ownTotal = 0,
    ownTimer = null;
  const OWN_LIMIT = 50;

  window.debounceOwnership = () => {
    clearTimeout(ownTimer);
    ownTimer = setTimeout(() => {
      ownPage = 1;
      loadOwnership();
    }, 400);
  };
  window.ownershipPage = (d) => {
    ownPage = Math.max(1, ownPage + d);
    loadOwnership();
  };

  async function loadOwnership() {
    const tbody = el("ownership-tbody");
    tbody.innerHTML = `<tr><td colspan="6">${emptyState("fa-spinner fa-spin", "Loading…")}</td></tr>`;
    const uid = el("search-user-id").value.trim();
    let url = `${API_URL}/public/ownership?page=${ownPage}&limit=${OWN_LIMIT}`;
    if (uid) url += `&public_user_id=${encodeURIComponent(uid)}`;
    try {
      const r = await fetch(url);
      const d = await r.json();
      ownTotal = d.total ?? 0;
      el("stat-total-gen").textContent = ownTotal.toLocaleString();
      const pages = Math.max(1, Math.ceil(ownTotal / OWN_LIMIT));
      el("own-page-info").textContent = `Page ${ownPage} / ${pages}`;
      el("own-prev").disabled = ownPage <= 1;
      el("own-next").disabled = ownPage >= pages;
      el("ownership-count-label").textContent =
        `${ownTotal.toLocaleString()} generation${ownTotal !== 1 ? "s" : ""} logged`;
      if (!d.results?.length) {
        tbody.innerHTML = `<tr><td colspan="6">${emptyState("fa-inbox", "No results found.")}</td></tr>`;
        return;
      }
      tbody.innerHTML = d.results
        .map(
          (row) => `
                <tr class="hover:bg-primary/[0.04] transition-colors">
                    <td class="px-4 py-2.5 border-b border-white/[0.04] align-middle">
                        <span class="inline-block bg-primary/10 text-primary border border-primary/20 rounded px-2 py-0.5 text-[0.72rem] max-w-[160px] truncate cursor-pointer hover:max-w-full hover:bg-primary/20 transition-all"
                            title="${row.public_user_id || ""}" onclick="copyHash(this,'${row.public_user_id || ""}')">
                            ${row.public_user_id || "—"}
                        </span>
                    </td>
                    <td class="px-4 py-2.5 border-b border-white/[0.04] align-middle">
                        <span class="inline-block bg-primary/10 text-primary rounded-full px-2 py-0.5 text-[0.72rem] font-bold">${row.provider || "—"}</span>
                    </td>
                    <td class="px-4 py-2.5 border-b border-white/[0.04] align-middle">
                        <span class="inline-block bg-primary/10 text-primary border border-primary/20 rounded px-2 py-0.5 text-[0.72rem] cursor-pointer hover:bg-primary/20 transition-all"
                            title="${row.prompt_hash || ""}" onclick="copyHash(this,'${row.prompt_hash || ""}')">
                            ${row.prompt_hash ? row.prompt_hash.slice(0, 16) + "…" : "—"}
                        </span>
                    </td>
                    <td class="px-4 py-2.5 border-b border-white/[0.04] align-middle">
                        <span class="inline-block bg-primary/10 text-primary border border-primary/20 rounded px-2 py-0.5 text-[0.72rem] cursor-pointer hover:bg-primary/20 transition-all"
                            title="${row.audio_content_hash || ""}" onclick="copyHash(this,'${row.audio_content_hash || ""}')">
                            ${row.audio_content_hash ? row.audio_content_hash.slice(0, 16) + "…" : "—"}
                        </span>
                    </td>
                    <td class="px-4 py-2.5 border-b border-white/[0.04] align-middle whitespace-nowrap text-gray-300">${row.duration != null ? row.duration + "s" : "—"}</td>
                    <td class="px-4 py-2.5 border-b border-white/[0.04] align-middle whitespace-nowrap text-gray-500">${fmtDate(row.generated_at)}</td>
                </tr>`,
        )
        .join("");
    } catch {
      tbody.innerHTML = `<tr><td colspan="6">${emptyState("fa-triangle-exclamation", "Failed to load.")}</td></tr>`;
    }
  }

  window.copyHash = function (chip, text) {
    navigator.clipboard.writeText(text).then(() => {
      chip.classList.add("bg-success/10", "text-success", "border-success/20");
      chip.classList.remove(
        "bg-primary/10",
        "text-primary",
        "border-primary/20",
      );
      chip.textContent = "Copied!";
      setTimeout(() => {
        chip.classList.remove(
          "bg-success/10",
          "text-success",
          "border-success/20",
        );
        chip.classList.add(
          "bg-primary/10",
          "text-primary",
          "border-primary/20",
        );
        chip.textContent = text.length > 18 ? text.slice(0, 16) + "…" : text;
      }, 1500);
    });
  };

  async function loadNetwork() {
    const grid = el("network-grid");
    grid.innerHTML = emptyState("fa-spinner fa-spin", "Loading…");
    try {
      const r = await fetch(`${API_URL}/public/network`);
      const d = await r.json();
      if (!d.providers?.length) {
        grid.innerHTML = emptyState("fa-server", "No active providers.");
        return;
      }
      const sorted = [...d.providers].sort((a, b) => {
        if (a.is_trusted !== b.is_trusted)
          return (b.is_trusted ? 1 : 0) - (a.is_trusted ? 1 : 0);
        if (a.is_online !== b.is_online)
          return (b.is_online ? 1 : 0) - (a.is_online ? 1 : 0);
        return (b.jobs_done ?? 0) - (a.jobs_done ?? 0);
      });
      grid.innerHTML = sorted
        .map((p) => {
          const borderTop = p.is_trusted
            ? "bg-gradient-to-r from-primary to-[#a04840]"
            : p.is_online
              ? "bg-gradient-to-r from-success to-green-600"
              : "bg-white/10";
          const avatarColor = p.is_trusted
            ? "border-primary text-primary"
            : p.is_online
              ? "border-success text-success"
              : "border-white/10 text-gray-500";
          const icon = p.is_trusted ? "fa-shield" : "fa-server";
          const statusBadge = p.is_online
            ? `<span class="inline-flex items-center gap-1 bg-success/10 text-success border border-success/25 rounded-full px-2 py-0.5 text-[0.65rem] font-bold uppercase tracking-wider"><span class="w-1.5 h-1.5 rounded-full bg-success" style="box-shadow:0 0 4px #28c840"></span>Online</span>`
            : `<span class="inline-flex items-center gap-1 bg-white/5 text-gray-500 border border-white/10 rounded-full px-2 py-0.5 text-[0.65rem] font-bold uppercase tracking-wider">Offline</span>`;
          const trustedBadge = p.is_trusted
            ? `<span class="inline-flex items-center gap-1 bg-primary/10 text-primary border border-primary/30 rounded-full px-2 py-0.5 text-[0.65rem] font-bold uppercase tracking-wider"><i class="fas fa-shield"></i>Trusted</span>`
            : "";
          return `
                <div class="relative bg-white/[0.03] border border-white/[0.06] rounded-2xl p-4 flex items-center gap-4 hover:border-primary/40 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(217,104,80,0.15)] transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 inset-x-0 h-[3px] ${borderTop}"></div>
                    <div class="w-11 h-11 rounded-full border-2 ${avatarColor} flex items-center justify-center text-lg shrink-0 transition-colors">
                        <i class="fas ${icon}"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap font-bold text-white text-sm mb-0.5">${p.name} ${trustedBadge} ${statusBadge}</div>
                        <div class="text-[0.72rem] text-gray-500 font-mono">${p.last_seen ? "Last seen " + fmtDate(p.last_seen) : "Never seen"}</div>
                    </div>
                    <div class="text-right shrink-0">
                        <div class="text-2xl font-black text-primary leading-none">${(p.jobs_done ?? 0).toLocaleString()}</div>
                        <div class="text-[0.65rem] text-gray-500 uppercase tracking-wider mt-0.5">jobs done</div>
                    </div>
                </div>`;
        })
        .join("");
    } catch {
      grid.innerHTML = emptyState("fa-triangle-exclamation", "Failed to load.");
    }
  }

  let finPage = 1,
    finTotal = 0,
    finTimer = null;
  const FIN_LIMIT = 12;

  window.debounceFinances = () => {
    clearTimeout(finTimer);
    finTimer = setTimeout(() => {
      finPage = 1;
      loadFinances();
    }, 400);
  };
  window.financesPage = (d) => {
    finPage = Math.max(1, finPage + d);
    loadFinances();
  };

  async function loadFinances() {
    const grid = el("finances-grid");
    grid.innerHTML = `<div class="col-span-full">${emptyState("fa-spinner fa-spin", "Loading…")}</div>`;
    const month = el("search-month").value.trim();
    let url = `${API_URL}/public/finances?page=${finPage}&limit=${FIN_LIMIT}`;
    if (month) url += `&month=${encodeURIComponent(month)}`;
    try {
      const r = await fetch(url);
      const d = await r.json();
      finTotal = d.total ?? 0;
      const pages = Math.max(1, Math.ceil(finTotal / FIN_LIMIT));
      el("fin-page-info").textContent = `Page ${finPage} / ${pages}`;
      el("fin-prev").disabled = finPage <= 1;
      el("fin-next").disabled = finPage >= pages;
      el("finances-count-label").textContent =
        `${finTotal} report${finTotal !== 1 ? "s" : ""} available`;
      if (!d.reports?.length) {
        grid.innerHTML = `<div class="col-span-full">${emptyState("fa-file-invoice", "No reports found.")}</div>`;
        return;
      }
      grid.innerHTML = d.reports
        .map((rep) => {
          const distPct =
            rep.total_revenue_eur > 0
              ? Math.round(
                  (rep.distributable_eur / rep.total_revenue_eur) * 100,
                )
              : 0;
          return `
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5 hover:border-primary/40 hover:shadow-[0_8px_24px_rgba(217,104,80,0.15)] transition-all duration-300">
              <div class="inline-flex items-center gap-2 bg-gradient-to-r from-primary to-[#a04840] text-white rounded-full px-3 py-1 text-xs font-bold mb-4">
                  <i class="fas fa-calendar-alt"></i>${rep.month || "—"}
              </div>
              <div class="space-y-2">
                <div class="flex justify-between items-center py-2 border-b border-white/[0.05] text-sm">
                    <span class="text-gray-500">Total revenue</span>
                    <span class="font-black font-mono text-primary">€${fmt(rep.total_revenue_eur)}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-white/[0.05] text-sm">
                    <span class="text-gray-500">Platform fee (${rep.platform_fee_pct ?? 15}%)</span>
                    <span class="font-bold font-mono text-gray-300">€${fmt(rep.platform_fee_eur)}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500">Distributable (85%)</span>
                    <span class="font-black font-mono text-primary">€${fmt(rep.distributable_eur)}</span>
                </div>
                <div class="h-1.5 rounded-full bg-white/5 mt-2 mb-1 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-primary to-[#a04840] rounded-full transition-all duration-500" style="width:${distPct}%"></div>
                </div>
                <div class="text-[0.68rem] text-gray-600 mb-2">${distPct}% redistributed to providers</div>
                <div class="flex justify-between items-center py-2 border-b border-white/[0.05] text-sm">
                    <span class="text-gray-500">Eligible providers</span>
                    <span class="font-bold font-mono text-gray-300">${rep.eligible_providers ?? "—"}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-white/[0.05] text-sm">
                    <span class="text-gray-500">Share / provider</span>
                    <span class="font-black font-mono text-primary">€${fmt(rep.share_per_provider_eur)}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-white/[0.05] text-sm">
                    <span class="text-gray-500">Remainder</span>
                    <span class="font-bold font-mono text-gray-300">€${fmt(rep.remainder_eur)}</span>
                </div>
                <div class="py-2 text-sm">
                  <div class="flex justify-between items-center mb-3">
                      <span class="text-gray-500">Transfers</span>
                      <span class="text-xs text-gray-600 font-mono">
                          ${rep.transfers ? Object.keys(rep.transfers).length : 0} entries
                      </span>
                  </div>
                  <div class="space-y-2">
                    ${
                      rep.transfers
                        ? Object.values(rep.transfers)
                            .map((t) => {
                              const uptime =
                                typeof t.uptime_score_pct === "object"
                                  ? t.uptime_score_pct.parsedValue
                                  : t.uptime_score_pct;
                              const amount =
                                typeof t.amount_eur === "object"
                                  ? t.amount_eur.parsedValue
                                  : t.amount_eur;
                              const safeName = (t.provider_name || "").replace(
                                /</g,
                                "&lt;",
                              );

                              return `
                    <div class="bg-white/[0.03] border border-white/[0.05] rounded-lg p-3 text-[0.7rem] font-mono">
                      <div class="font-bold text-primary mb-2 truncate">${safeName}</div>
                      <div class="flex justify-between mb-1"><span class="text-gray-500">Jobs:</span><span class="text-gray-200">${t.billable_jobs ?? 0}</span></div>
                      <div class="flex justify-between mb-1"><span class="text-gray-500">Uptime:</span><span class="text-gray-200">${uptime}%</span></div>
                      <div class="flex justify-between"><span class="text-gray-500">Amount:</span><span class="text-white font-bold">€${amount}</span></div>
                    </div>`;
                            })
                            .join("")
                        : '<span class="text-gray-600">—</span>'
                    }
                  </div>
                  <div class="flex justify-between items-center py-2 text-sm mt-3">
                      <span class="text-gray-500">Published</span>
                      <span class="font-mono text-[0.72rem] text-gray-500">${shortDate(rep.published_at)}</span>
                  </div>
                </div>
              </div>`;
        })
        .join("");
    } catch {
      grid.innerHTML = `<div class="col-span-full">${emptyState("fa-triangle-exclamation", "Failed to load.")}</div>`;
    }
  }

  loadPublicStats();
  loadOwnership();
  loadNetwork();
  loadFinances();
})();
