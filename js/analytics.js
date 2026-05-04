let analyticsChart = null;
let currentAnalyticsPeriod = 30;
let isLoading = false;
let worldMap = null;
let worldMapMarkers = [];

function spinnerRow(colspan) {
  return `<tr><td colspan="${colspan}" class="text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-xl"></i></td></tr>`;
}
function spinnerBox() {
  return `<div class="flex items-center justify-center h-full py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></div>`;
}
function spinnerGrid() {
  return `<div class="col-span-full text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></div>`;
}
function emptyRow(colspan, msg = "No data available") {
  return `<tr><td colspan="${colspan}" class="text-center py-6 text-gray-600">${msg}</td></tr>`;
}
function errorRow(colspan) {
  return `<tr><td colspan="${colspan}" class="text-center py-6 text-danger">Error loading data</td></tr>`;
}

async function loadWorldMap(days) {
  const mapContainer = document.getElementById("analytics-world-map");
  try {
    const data = await API.getCountries(days, 50);

    if (!data.countries?.length) {
      mapContainer.innerHTML = `<div class="flex items-center justify-center h-full text-gray-600">No data available</div>`;
      return;
    }

    if (worldMap) {
      worldMap.remove();
      worldMap = null;
      worldMapMarkers = [];
    }
    mapContainer.innerHTML = "";
    mapContainer.style.height = "400px";
    await new Promise((r) => setTimeout(r, 100));

    worldMap = L.map("analytics-world-map", {
      center: [20, 0],
      zoom: 2,
      minZoom: 2,
      maxZoom: 5,
      worldCopyJump: true,
    });
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: "© OpenStreetMap contributors",
      noWrap: false,
      maxZoom: 19,
    }).addTo(worldMap);

    const countryCoords = {
      Italy: [41.9, 12.5],
      "United States": [37.1, -95.7],
      France: [46.2, 2.2],
      "United Kingdom": [55.4, -3.4],
      Germany: [51.2, 10.5],
      Spain: [40.5, -3.7],
      Canada: [56.1, -106.3],
      Australia: [-25.3, 133.8],
      Brazil: [-14.2, -51.9],
      Russia: [61.5, 105.3],
      Japan: [36.2, 138.3],
      China: [35.9, 104.2],
      India: [20.6, 78.9],
      Mexico: [23.6, -102.6],
      Netherlands: [52.1, 5.3],
      Belgium: [50.5, 4.5],
      Switzerland: [46.8, 8.2],
      Sweden: [60.1, 18.6],
      Norway: [60.5, 8.5],
      Poland: [51.9, 19.1],
      Argentina: [-38.4, -63.6],
      "South Africa": [-30.6, 22.9],
      "South Korea": [35.9, 127.8],
      Turkey: [38.9, 35.2],
      Greece: [39.1, 21.8],
      Portugal: [39.4, -8.2],
      Austria: [47.5, 14.6],
      Denmark: [56.3, 9.5],
      Finland: [61.9, 25.7],
      Ireland: [53.4, -8.2],
      "New Zealand": [-40.9, 174.9],
      Singapore: [1.4, 103.8],
      UAE: [23.4, 53.8],
      Israel: [31.0, 34.9],
      Thailand: [15.9, 100.9],
      Vietnam: [14.1, 108.3],
      Philippines: [12.9, 121.8],
      Malaysia: [4.2, 101.9],
      Indonesia: [-0.8, 113.9],
      Chile: [-35.7, -71.5],
      Colombia: [4.6, -74.1],
      Peru: [-9.2, -75.0],
      Egypt: [26.8, 30.8],
      Morocco: [31.8, -7.1],
      Nigeria: [9.1, 8.7],
      Kenya: [-0.0, 37.9],
      Bulgaria: [42.7, 25.5],
      Romania: [45.9, 24.9],
      "Czech Republic": [49.8, 15.5],
      Hungary: [47.2, 19.5],
      Ukraine: [48.4, 31.2],
    };

    const maxUsers = Math.max(...data.countries.map((c) => c.users));
    data.countries.forEach((country) => {
      const coords = countryCoords[country.country];
      if (!coords) return;
      const intensity = country.users / maxUsers;
      const color = getColorForIntensity(intensity);
      const size = 8 + (30 - 8) * intensity;
      const marker = L.circleMarker(coords, {
        radius: size,
        fillColor: color,
        color: "#fff",
        weight: 2,
        opacity: 1,
        fillOpacity: 0.7,
      }).addTo(worldMap);
      marker.bindTooltip(
        `<div style="text-align:center;font-size:12px"><strong style="font-size:14px">${country.country}</strong><br><span style="color:#d96850;font-weight:bold">${country.users.toLocaleString()}</span> users<br><span style="color:#666">${country.sessions.toLocaleString()}</span> sessions</div>`,
        { permanent: false, direction: "top", offset: [0, -10] },
      );
      marker.bindPopup(
        `<div style="text-align:center"><strong>${country.country}</strong><br><span style="color:#d96850">${country.users.toLocaleString()}</span> users<br><span style="color:#666">${country.sessions.toLocaleString()}</span> sessions</div>`,
      );
      worldMapMarkers.push(marker);
    });
  } catch (error) {
    console.error("Error loading world map:", error);
    mapContainer.innerHTML = `<div class="flex items-center justify-center h-full text-danger">Error loading map</div>`;
  }
}

function getColorForIntensity(intensity) {
  const colors = [
    "#ffcccc",
    "#ff9999",
    "#ff6666",
    "#ff3333",
    "#cc0000",
    "#990000",
  ];
  return colors[
    Math.min(Math.floor(intensity * colors.length), colors.length - 1)
  ];
}

async function loadSocialReferrals(days) {
  const container = document.getElementById("analytics-social-media");
  try {
    const data = await API.getSocialReferrals(days);
    if (!data.social?.length) {
      container.innerHTML = `<div class="col-span-full text-center py-6 text-gray-600">No social media traffic data</div>`;
      return;
    }
    const socialIcons = {
      Facebook: { icon: "fab fa-facebook", color: "#1877f2" },
      Instagram: { icon: "fab fa-instagram", color: "#e4405f" },
      Twitter: { icon: "fab fa-twitter", color: "#1da1f2" },
      LinkedIn: { icon: "fab fa-linkedin", color: "#0a66c2" },
      Reddit: { icon: "fab fa-reddit", color: "#ff4500" },
      TikTok: { icon: "fab fa-tiktok", color: "#333333" },
      YouTube: { icon: "fab fa-youtube", color: "#ff0000" },
      Pinterest: { icon: "fab fa-pinterest", color: "#e60023" },
      Snapchat: { icon: "fab fa-snapchat", color: "#ffd700" },
      WhatsApp: { icon: "fab fa-whatsapp", color: "#25d366" },
      Telegram: { icon: "fab fa-telegram", color: "#0088cc" },
      Discord: { icon: "fab fa-discord", color: "#5865f2" },
    };
    container.innerHTML = data.social
      .map((s) => {
        const ic = socialIcons[s.platform] || {
          icon: "fas fa-share-alt",
          color: "#999",
        };
        return `
                <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4" style="background:linear-gradient(135deg,${ic.color}18 0%,${ic.color}06 100%)">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background:${ic.color}">
                            <i class="${ic.icon} text-white text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-white text-sm mb-0">${s.platform}</h5>
                            <p class="text-xs text-gray-500 mb-0">${s.sessions.toLocaleString()} sessions</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 text-center gap-2">
                        <div>
                            <div class="text-xl font-black" style="color:${ic.color}">${s.active_users.toLocaleString()}</div>
                            <div class="text-xs text-gray-500">Users</div>
                        </div>
                        <div>
                            <div class="text-xl font-black text-success">${s.new_users.toLocaleString()}</div>
                            <div class="text-xs text-gray-500">New</div>
                        </div>
                    </div>
                </div>`;
      })
      .join("");
  } catch (error) {
    console.error("Error loading social media:", error);
    container.innerHTML = `<div class="col-span-full text-center py-6 text-danger">Error loading social data</div>`;
  }
}

window.loadAnalytics = async function (days = 30) {
  if (isLoading) return;
  isLoading = true;
  currentAnalyticsPeriod = days;

  document
    .querySelectorAll("#section-analytics button[onclick^='loadAnalytics']")
    .forEach((btn) => {
      const isActive = btn.textContent
        .trim()
        .startsWith(days === 9999 ? "All" : days.toString());
      btn.classList.toggle("bg-gradient-to-r", isActive);
      btn.classList.toggle("from-primary", isActive);
      btn.classList.toggle("to-[#a04840]", isActive);
      btn.classList.toggle("text-white", isActive);
      btn.classList.toggle("border-white/20", !isActive);
      btn.classList.toggle("text-gray-400", !isActive);
    });

  try {
    showLoadingState();
    await Promise.all([
      loadAnalyticsOverview(days),
      loadAnalyticsDaily(days),
      loadTopPages(days),
      loadTrafficSources(days),
      loadDeviceBreakdown(days),
      loadWorldMap(days),
      loadCountries(days),
      loadSocialReferrals(days),
    ]);
    showNotification("Analytics data loaded successfully", "success");
  } catch (error) {
    console.error("Error loading analytics:", error);
    showNotification("Error loading analytics data", "danger");
  } finally {
    isLoading = false;
  }
};

function showLoadingState() {
  const spin = `<i class="fas fa-spinner fa-spin text-xl text-gray-600"></i>`;
  [
    "analytics-active-users",
    "analytics-new-users",
    "analytics-page-views",
    "analytics-avg-session",
  ].forEach((id) => {
    document.getElementById(id).innerHTML = spin;
  });
  document.getElementById("analytics-top-pages").innerHTML = spinnerRow(3);
  document.getElementById("analytics-traffic-sources").innerHTML =
    spinnerRow(3);
  document.getElementById("analytics-countries").innerHTML = spinnerRow(3);
  document.getElementById("analytics-devices").innerHTML =
    `<div class="col-span-full text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-xl"></i></div>`;
  document.getElementById("analytics-world-map").innerHTML = spinnerBox();
}

async function loadAnalyticsOverview(days) {
  try {
    const data = await API.getAnalyticsOverview(days);
    if (data.stats) {
      document.getElementById("analytics-active-users").textContent =
        data.stats.active_users.toLocaleString();
      document.getElementById("analytics-new-users").textContent =
        data.stats.new_users.toLocaleString();
      document.getElementById("analytics-page-views").textContent =
        data.stats.page_views.toLocaleString();
      document.getElementById("analytics-avg-session").textContent =
        Math.round(data.stats.avg_session_duration) + "s";
    }
  } catch (error) {
    console.error("Error loading overview:", error);
    [
      "analytics-active-users",
      "analytics-new-users",
      "analytics-page-views",
      "analytics-avg-session",
    ].forEach((id) => {
      document.getElementById(id).textContent = "Error";
    });
  }
}

async function loadAnalyticsDaily(days) {
  try {
    const data = await API.getAnalyticsDaily(days);
    if (data.data?.length) {
      if (analyticsChart) {
        analyticsChart.destroy();
      }
      const ctx = document
        .getElementById("analytics-daily-chart")
        .getContext("2d");
      analyticsChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: data.data.map((d) => d.date),
          datasets: [
            {
              label: "Active Users",
              data: data.data.map((d) => d.active_users),
              borderColor: "rgb(184,96,92)",
              backgroundColor: "rgba(184,96,92,0.1)",
              tension: 0.4,
              fill: true,
            },
            {
              label: "New Users",
              data: data.data.map((d) => d.new_users),
              borderColor: "rgb(201,117,113)",
              backgroundColor: "rgba(201,117,113,0.1)",
              tension: 0.4,
              fill: true,
            },
            {
              label: "Sessions",
              data: data.data.map((d) => d.sessions),
              borderColor: "rgb(212,165,160)",
              backgroundColor: "rgba(212,165,160,0.1)",
              tension: 0.4,
              fill: true,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          plugins: {
            legend: { position: "top", labels: { color: "#9ca3af" } },
            tooltip: { mode: "index", intersect: false },
          },
          scales: {
            y: { beginAtZero: true, ticks: { color: "#9ca3af" } },
            x: { ticks: { color: "#9ca3af" } },
          },
        },
      });
    } else {
      if (analyticsChart) {
        analyticsChart.destroy();
        analyticsChart = null;
      }
    }
  } catch (error) {
    console.error("Error loading daily chart:", error);
  }
}

async function loadTopPages(days) {
  const tbody = document.getElementById("analytics-top-pages");
  try {
    const data = await API.getTopPages(days, 10);
    if (data.pages?.length) {
      tbody.innerHTML = data.pages
        .map(
          (p) => `
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="px-3 py-2.5 border-b border-white/[0.04]">
                        <div class="font-bold text-white text-xs">${p.title || "Untitled"}</div>
                        <div class="text-[0.65rem] text-gray-500 font-mono">${p.path}</div>
                    </td>
                    <td class="px-3 py-2.5 border-b border-white/[0.04] font-bold text-white text-xs">${p.views.toLocaleString()}</td>
                    <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 text-xs">${Math.round(p.avg_time)}s</td>
                </tr>`,
        )
        .join("");
    } else {
      tbody.innerHTML = emptyRow(3);
    }
  } catch {
    tbody.innerHTML = errorRow(3);
  }
}

async function loadTrafficSources(days) {
  const tbody = document.getElementById("analytics-traffic-sources");
  try {
    const data = await API.getTrafficSources(days);
    if (data.sources?.length) {
      tbody.innerHTML = data.sources
        .map(
          (s) => `
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="px-3 py-2.5 border-b border-white/[0.04]">
                        <i class="fas fa-circle text-primary mr-2" style="font-size:6px;vertical-align:middle"></i>
                        <span class="font-bold text-white text-xs">${s.source}</span>
                    </td>
                    <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 text-xs">${s.sessions.toLocaleString()}</td>
                    <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 text-xs">${s.new_users.toLocaleString()}</td>
                </tr>`,
        )
        .join("");
    } else {
      tbody.innerHTML = emptyRow(3);
    }
  } catch {
    tbody.innerHTML = errorRow(3);
  }
}

async function loadDeviceBreakdown(days) {
  const container = document.getElementById("analytics-devices");
  try {
    const data = await API.getDeviceBreakdown(days);
    if (data.devices?.length) {
      const icons = {
        desktop: "desktop",
        mobile: "mobile-alt",
        tablet: "tablet-alt",
      };
      container.innerHTML = data.devices
        .map(
          (d) => `
                <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4 text-center">
                    <i class="fas fa-${icons[d.device.toLowerCase()] || "laptop"} text-primary text-3xl mb-3 block"></i>
                    <div class="text-2xl font-black text-white mb-1">${d.users.toLocaleString()}</div>
                    <div class="text-sm text-gray-400 mb-0.5">${d.device}</div>
                    <div class="text-xs text-gray-600">${d.sessions.toLocaleString()} sessions</div>
                </div>`,
        )
        .join("");
    } else {
      container.innerHTML = `<div class="col-span-full text-center py-6 text-gray-600">No data available</div>`;
    }
  } catch {
    container.innerHTML = `<div class="col-span-full text-center py-6 text-danger">Error loading data</div>`;
  }
}

async function loadCountries(days) {
  const tbody = document.getElementById("analytics-countries");
  try {
    const data = await API.getCountries(days, 10);
    if (data.countries?.length) {
      tbody.innerHTML = data.countries
        .map(
          (c) => `
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="px-3 py-2.5 border-b border-white/[0.04]">
                        <i class="fas fa-flag text-primary mr-2 text-xs"></i>
                        <span class="font-bold text-white text-xs">${c.country}</span>
                    </td>
                    <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 text-xs">${c.users.toLocaleString()}</td>
                    <td class="px-3 py-2.5 border-b border-white/[0.04] text-gray-400 text-xs">${c.sessions.toLocaleString()}</td>
                </tr>`,
        )
        .join("");
    } else {
      tbody.innerHTML = emptyRow(3);
    }
  } catch {
    tbody.innerHTML = errorRow(3);
  }
}

window.initAnalyticsSection = function () {
  loadAnalytics(30);
};
