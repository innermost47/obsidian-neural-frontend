let analyticsChart = null;
let currentAnalyticsPeriod = 30;
let isLoading = false;
let worldMap = null;
let worldMapMarkers = [];

async function loadWorldMap(days) {
  try {
    const data = await API.getCountries(days, 50);

    const mapContainer = document.getElementById("analytics-world-map");

    if (!data.countries || data.countries.length === 0) {
      mapContainer.innerHTML =
        '<div class="d-flex align-items-center justify-content-center h-100 text-muted">No data available</div>';
      return;
    }

    if (worldMap) {
      worldMap.remove();
      worldMap = null;
      worldMapMarkers = [];
    }

    mapContainer.innerHTML = "";
    mapContainer.style.height = "400px";

    await new Promise((resolve) => setTimeout(resolve, 100));

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
      if (coords) {
        const intensity = country.users / maxUsers;
        const color = getColorForIntensity(intensity);

        const baseSize = 8;
        const maxSize = 30;
        const size = baseSize + (maxSize - baseSize) * intensity;

        const marker = L.circleMarker(coords, {
          radius: size,
          fillColor: color,
          color: "#fff",
          weight: 2,
          opacity: 1,
          fillOpacity: 0.7,
        }).addTo(worldMap);

        marker.bindTooltip(
          `
          <div style="text-align: center; font-size: 12px;">
            <strong style="font-size: 14px;">${country.country}</strong><br>
            <span style="color: var(--color-primary); font-weight: bold;">${country.users.toLocaleString()}</span> users<br>
            <span style="color: #666;">${country.sessions.toLocaleString()}</span> sessions
          </div>
        `,
          {
            permanent: false,
            direction: "top",
            offset: [0, -10],
            className: "custom-tooltip",
          },
        );

        marker.bindPopup(`
          <div style="text-align: center;">
            <strong>${country.country}</strong><br>
            <span style="color: var(--color-primary);">${country.users.toLocaleString()}</span> users<br>
            <span style="color: #666;">${country.sessions.toLocaleString()}</span> sessions
          </div>
        `);

        worldMapMarkers.push(marker);
      }
    });
  } catch (error) {
    console.error("Error loading world map:", error);
    document.getElementById("analytics-world-map").innerHTML =
      '<div class="d-flex align-items-center justify-content-center h-100 text-danger">Error loading map</div>';
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

  const index = Math.min(
    Math.floor(intensity * colors.length),
    colors.length - 1,
  );
  return colors[index];
}

async function loadConversionFunnel(days) {
  const container = document.getElementById("analytics-funnel-container");
  const summaryContainer = document.getElementById("analytics-funnel-summary");
  const pathsContainer = document.getElementById("analytics-paths");

  try {
    const data = await API.getConversionFunnel(days);

    if (data.funnel && data.funnel.length > 0) {
      let html = '<div class="funnel-steps">';

      data.funnel.forEach((step, index) => {
        const widthPercent = step.conversion_rate;

        let dropOffText = "";
        if (index > 0) {
          const dropOff = step.drop_off;
          if (dropOff > 0) {
            dropOffText = `<small class="text-danger"><i class="fas fa-arrow-down me-1"></i>${dropOff} dropped (${step.retention_rate.toFixed(
              0,
            )}% stayed)</small>`;
          } else if (dropOff < 0) {
            dropOffText = `<small class="text-success"><i class="fas fa-arrow-up me-1"></i>${Math.abs(
              dropOff,
            )} joined directly</small>`;
          }
        }

        html += `
          <div class="funnel-step" style="margin-bottom: 20px;">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div>
                <strong style="font-size: 16px;">${step.name}</strong>
                <div class="text-muted" style="font-size: 13px;">
                  ${step.description}
                </div>
                <div class="text-muted" style="font-size: 12px; margin-top: 4px;">
                  ${step.users.toLocaleString()} users • ${step.views.toLocaleString()} views
                </div>
              </div>
              <div class="text-end">
                <div style="font-size: 24px; font-weight: bold; color: var(--color-primary);">
                  ${step.conversion_rate.toFixed(1)}%
                </div>
                ${dropOffText}
              </div>
            </div>
            <div class="progress" style="height: 35px; background-color: #f0f0f0; border-radius: 8px;">
              <div class="progress-bar" 
                   style="width: ${widthPercent}%; background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%); font-weight: bold; font-size: 14px;"
                   role="progressbar">
                ${step.users.toLocaleString()} users
              </div>
            </div>
          </div>
        `;
      });

      html += "</div>";
      container.innerHTML = html;
    } else {
      container.innerHTML =
        '<div class="text-center text-muted py-3">No funnel data available</div>';
    }

    if (data.summary) {
      const s = data.summary;
      summaryContainer.innerHTML = `
        <div class="mb-3 pb-3 border-bottom">
          <div class="text-muted small">Total Visitors</div>
          <div class="h4 mb-0 fw-bold">${s.total_visitors.toLocaleString()}</div>
        </div>
        <div class="mb-3 pb-3 border-bottom">
          <div class="text-muted small">Overall Conversion</div>
          <div class="h4 mb-0 fw-bold text-success">${s.overall_conversion_rate.toFixed(
            1,
          )}%</div>
          <small class="text-muted">${s.successful_conversions} / ${
            s.total_visitors
          } visitors</small>
        </div>
        <div class="mb-3 pb-3 border-bottom">
          <div class="text-muted small">Signup Completion</div>
          <div class="h4 mb-0 fw-bold text-primary">${s.signup_completion_rate.toFixed(
            1,
          )}%</div>
          <small class="text-muted">${s.successful_conversions} / ${
            s.registration_attempts
          } signups</small>
        </div>
        <div>
          <div class="text-muted small">Total Pageviews</div>
          <div class="h5 mb-0">${s.total_pageviews.toLocaleString()}</div>
        </div>
      `;
    }

    if (data.paths) {
      pathsContainer.innerHTML = Object.values(data.paths)
        .map(
          (path) => `
        <div class="col-md-6 col-lg-4">
          <div class="p-3 border rounded" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
            <div class="d-flex align-items-center mb-2">
              <i class="fas ${
                path.icon
              } fa-2x me-3" style="color: var(--color-primary);"></i>
              <div>
                <div class="fw-bold">${path.name}</div>
                <small class="text-muted">${path.description}</small>
              </div>
            </div>
            <div class="text-center mt-3">
              <div class="h3 mb-0 fw-bold" style="color: var(--color-primary);">
                ${path.count.toLocaleString()}
              </div>
              ${
                path.rate !== undefined
                  ? `<small class="text-success fw-bold">${path.rate.toFixed(
                      1,
                    )}% rate</small>`
                  : ""
              }
            </div>
          </div>
        </div>
      `,
        )
        .join("");
    }
  } catch (error) {
    console.error("Error loading conversion funnel:", error);
    container.innerHTML =
      '<div class="text-center text-danger py-3">Error loading funnel data</div>';
    summaryContainer.innerHTML =
      '<div class="text-center text-danger py-3">Error</div>';
    pathsContainer.innerHTML =
      '<div class="col-12 text-center text-danger py-3">Error loading paths</div>';
  }
}

async function loadSocialReferrals(days) {
  const container = document.getElementById("analytics-social-media");

  try {
    const data = await API.getSocialReferrals(days);

    if (data.social && data.social.length > 0) {
      const socialIcons = {
        Facebook: { icon: "fab fa-facebook", color: "#1877f2" },
        Instagram: { icon: "fab fa-instagram", color: "#e4405f" },
        Twitter: { icon: "fab fa-twitter", color: "#1da1f2" },
        LinkedIn: { icon: "fab fa-linkedin", color: "#0a66c2" },
        Reddit: { icon: "fab fa-reddit", color: "#ff4500" },
        TikTok: { icon: "fab fa-tiktok", color: "#000000" },
        YouTube: { icon: "fab fa-youtube", color: "#ff0000" },
        Pinterest: { icon: "fab fa-pinterest", color: "#e60023" },
        Snapchat: { icon: "fab fa-snapchat", color: "#fffc00" },
        WhatsApp: { icon: "fab fa-whatsapp", color: "#25d366" },
        Telegram: { icon: "fab fa-telegram", color: "#0088cc" },
        Discord: { icon: "fab fa-discord", color: "#5865f2" },
      };

      container.innerHTML = data.social
        .map((social) => {
          const iconData = socialIcons[social.platform] || {
            icon: "fas fa-share-alt",
            color: "#999",
          };

          return `
          <div class="col-md-6 col-lg-4">
            <div class="social-card p-3 border rounded" style="background: linear-gradient(135deg, ${
              iconData.color
            }15 0%, ${iconData.color}05 100%);">
              <div class="d-flex align-items-center mb-3">
                <div class="social-icon me-3" style="width: 50px; height: 50px; background-color: ${
                  iconData.color
                }; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                  <i class="${iconData.icon} fa-2x" style="color: white;"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">${social.platform}</h5>
                  <small class="text-muted">${social.sessions.toLocaleString()} sessions</small>
                </div>
              </div>
              <div class="row text-center">
                <div class="col-6">
                  <div class="fw-bold" style="font-size: 20px; color: ${
                    iconData.color
                  };">
                    ${social.active_users.toLocaleString()}
                  </div>
                  <small class="text-muted">Users</small>
                </div>
                <div class="col-6">
                  <div class="fw-bold" style="font-size: 20px; color: #28a745;">
                    ${social.new_users.toLocaleString()}
                  </div>
                  <small class="text-muted">New</small>
                </div>
              </div>
            </div>
          </div>
        `;
        })
        .join("");
    } else {
      container.innerHTML =
        '<div class="col-12 text-center text-muted py-3">No social media traffic data</div>';
    }
  } catch (error) {
    console.error("Error loading social media:", error);
    container.innerHTML =
      '<div class="col-12 text-center text-danger py-3">Error loading social data</div>';
  }
}

async function loadAnalytics(days = 30) {
  if (isLoading) return;

  isLoading = true;
  currentAnalyticsPeriod = days;

  document.querySelectorAll(".btn-group .btn").forEach((btn) => {
    btn.classList.remove("active");
  });
  if (event?.target) {
    event.target.classList.add("active");
  } else {
    document.querySelectorAll(".btn-group .btn").forEach((btn) => {
      if (btn.textContent.includes(`${days} Days`)) {
        btn.classList.add("active");
      }
    });
  }

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
      loadConversionFunnel(days),
      loadSocialReferrals(days),
    ]);

    showNotification("Analytics data loaded successfully", "success");
  } catch (error) {
    console.error("Error loading analytics:", error);
    showNotification("Error loading analytics data", "danger");
  } finally {
    isLoading = false;
  }
}

function showLoadingState() {
  document.getElementById("analytics-active-users").innerHTML =
    '<div class="spinner-border spinner-border-sm" role="status"></div>';
  document.getElementById("analytics-new-users").innerHTML =
    '<div class="spinner-border spinner-border-sm" role="status"></div>';
  document.getElementById("analytics-page-views").innerHTML =
    '<div class="spinner-border spinner-border-sm" role="status"></div>';
  document.getElementById("analytics-avg-session").innerHTML =
    '<div class="spinner-border spinner-border-sm" role="status"></div>';

  document.getElementById("analytics-top-pages").innerHTML = `
    <tr>
      <td colspan="3" class="text-center py-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </td>
    </tr>
  `;

  document.getElementById("analytics-traffic-sources").innerHTML = `
    <tr>
      <td colspan="3" class="text-center py-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </td>
    </tr>
  `;

  document.getElementById("analytics-devices").innerHTML = `
    <div class="col-12 text-center py-4">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  `;
  document.getElementById("analytics-countries").innerHTML = `
    <tr>
      <td colspan="3" class="text-center py-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </td>
    </tr>
  `;
  document.getElementById("analytics-world-map").innerHTML = `
    <div class="d-flex align-items-center justify-content-center h-100">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  `;
  document.getElementById("analytics-funnel-summary").innerHTML = `
  <div class="text-center py-4">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
`;
  document.getElementById("analytics-paths").innerHTML = `
  <div class="col-12 text-center py-4">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
`;
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

      const avgSessionMin = Math.round(data.stats.avg_session_duration);
      document.getElementById("analytics-avg-session").textContent =
        avgSessionMin + "s";
    }
  } catch (error) {
    console.error("Error loading overview:", error);
    document.getElementById("analytics-active-users").textContent = "Error";
    document.getElementById("analytics-new-users").textContent = "Error";
    document.getElementById("analytics-page-views").textContent = "Error";
    document.getElementById("analytics-avg-session").textContent = "Error";
  }
}

async function loadAnalyticsDaily(days) {
  try {
    const data = await API.getAnalyticsDaily(days);
    if (data.data && data.data.length > 0) {
      const labels = data.data.map((d) => d.date);
      const activeUsers = data.data.map((d) => d.active_users);
      const newUsers = data.data.map((d) => d.new_users);
      const sessions = data.data.map((d) => d.sessions);

      if (analyticsChart) {
        analyticsChart.destroy();
      }

      const ctx = document
        .getElementById("analytics-daily-chart")
        .getContext("2d");
      analyticsChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Active Users",
              data: activeUsers,
              borderColor: "rgb(184, 96, 92)",
              backgroundColor: "rgba(184, 96, 92, 0.1)",
              tension: 0.4,
              fill: true,
            },
            {
              label: "New Users",
              data: newUsers,
              borderColor: "rgb(201, 117, 113)",
              backgroundColor: "rgba(201, 117, 113, 0.1)",
              tension: 0.4,
              fill: true,
            },
            {
              label: "Sessions",
              data: sessions,
              borderColor: "rgb(212, 165, 160)",
              backgroundColor: "rgba(212, 165, 160, 0.1)",
              tension: 0.4,
              fill: true,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          plugins: {
            legend: {
              position: "top",
            },
            tooltip: {
              mode: "index",
              intersect: false,
            },
          },
          scales: {
            y: {
              beginAtZero: true,
            },
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
    if (data.pages && data.pages.length > 0) {
      tbody.innerHTML = data.pages
        .map(
          (page) => `
        <tr>
          <td>
            <div>
              <strong>${page.title || "Untitled"}</strong><br>
              <small class="text-muted">${page.path}</small>
            </div>
          </td>
          <td><strong>${page.views.toLocaleString()}</strong></td>
          <td>${Math.round(page.avg_time)}s</td>
        </tr>
      `,
        )
        .join("");
    } else {
      tbody.innerHTML =
        '<tr><td colspan="3" class="text-center text-muted py-3">No data available</td></tr>';
    }
  } catch (error) {
    console.error("Error loading top pages:", error);
    tbody.innerHTML =
      '<tr><td colspan="3" class="text-center text-danger py-3">Error loading data</td></tr>';
  }
}

async function loadTrafficSources(days) {
  const tbody = document.getElementById("analytics-traffic-sources");

  try {
    const data = await API.getTrafficSources(days);
    if (data.sources && data.sources.length > 0) {
      tbody.innerHTML = data.sources
        .map(
          (source) => `
        <tr>
          <td>
            <i class="fas fa-circle me-2" style="color: var(--color-primary); font-size: 8px;"></i>
            <strong>${source.source}</strong>
          </td>
          <td>${source.sessions.toLocaleString()}</td>
          <td>${source.new_users.toLocaleString()}</td>
        </tr>
      `,
        )
        .join("");
    } else {
      tbody.innerHTML =
        '<tr><td colspan="3" class="text-center text-muted py-3">No data available</td></tr>';
    }
  } catch (error) {
    console.error("Error loading traffic sources:", error);
    tbody.innerHTML =
      '<tr><td colspan="3" class="text-center text-danger py-3">Error loading data</td></tr>';
  }
}

async function loadDeviceBreakdown(days) {
  const container = document.getElementById("analytics-devices");

  try {
    const data = await API.getDeviceBreakdown(days);
    if (data.devices && data.devices.length > 0) {
      const icons = {
        desktop: "desktop",
        mobile: "mobile-alt",
        tablet: "tablet-alt",
      };

      container.innerHTML = data.devices
        .map(
          (device) => `
        <div class="col-md-4">
          <div class="p-3 bg-light rounded text-center">
            <i class="fas fa-${
              icons[device.device.toLowerCase()] || "laptop"
            } fa-3x text-primary mb-3"></i>
            <h4 class="fw-bold mb-1">${device.users.toLocaleString()}</h4>
            <p class="text-muted mb-1">${device.device}</p>
            <small class="text-muted">${device.sessions.toLocaleString()} sessions</small>
          </div>
        </div>
      `,
        )
        .join("");
    } else {
      container.innerHTML =
        '<div class="col-12 text-center text-muted py-3">No data available</div>';
    }
  } catch (error) {
    console.error("Error loading device breakdown:", error);
    container.innerHTML =
      '<div class="col-12 text-center text-danger py-3">Error loading data</div>';
  }
}

async function loadCountries(days) {
  const tbody = document.getElementById("analytics-countries");
  try {
    const data = await API.getCountries(days, 10);
    if (data.countries && data.countries.length > 0) {
      tbody.innerHTML = data.countries
        .map(
          (country) => `
        <tr>
          <td>
            <i class="fas fa-flag me-2 text-primary"></i>
            <strong>${country.country}</strong>
          </td>
          <td>${country.users.toLocaleString()}</td>
          <td>${country.sessions.toLocaleString()}</td>
        </tr>
      `,
        )
        .join("");
    } else {
      tbody.innerHTML =
        '<tr><td colspan="3" class="text-center text-muted py-3">No data available</td></tr>';
    }
  } catch (error) {
    console.error("Error loading countries:", error);
    tbody.innerHTML =
      '<tr><td colspan="3" class="text-center text-danger py-3">Error loading data</td></tr>';
  }
}

function initAnalyticsSection() {
  console.log("Initializing analytics section...");
  loadAnalytics(30);
  setTimeout(() => {
    const tooltipTriggerList = document.querySelectorAll(
      '[data-bs-toggle="tooltip"]',
    );
    [...tooltipTriggerList].map(
      (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl),
    );
  }, 500);
}
