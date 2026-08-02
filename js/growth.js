document.addEventListener("DOMContentLoaded", async () => {
  const totalEl = document.getElementById("growth-total-users");
  const canvas = document.getElementById("growth-chart");
  const section = canvas?.closest("section");
  if (!totalEl || !canvas || !section) return;

  let currentTotal = 0;
  let chartInstance = null;
  let hasAnimatedIn = false;
  let latestData = null;

  function animateCountTo(target, duration = 1500) {
    const start = currentTotal;
    const startTime = performance.now();

    function tick(now) {
      const elapsed = now - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
      const value = Math.round(start + (target - start) * eased);
      totalEl.textContent = value.toLocaleString();
      if (progress < 1) {
        requestAnimationFrame(tick);
      } else {
        currentTotal = target;
      }
    }
    requestAnimationFrame(tick);
  }

  function bumpTotal(newTotal) {
    if (newTotal === currentTotal) return;
    totalEl.classList.add("growth-bump");
    animateCountTo(newTotal, newTotal > currentTotal ? 800 : 1500);
    setTimeout(() => totalEl.classList.remove("growth-bump"), 600);
  }

  function buildChart(data) {
    const daily = data.daily_signups || [];
    const labels = daily.map((d) =>
      new Date(d.date).toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
      }),
    );

    let cumulative = 0;
    const cumulativeData = daily.map((d) => {
      cumulative += d.count;
      return cumulative;
    });
    const dailyData = daily.map((d) => d.count);

    if (chartInstance) chartInstance.destroy();

    chartInstance = new Chart(canvas, {
      data: {
        labels,
        datasets: [
          {
            type: "line",
            label: "Total users",
            data: cumulativeData,
            borderColor: "#d96850",
            backgroundColor: "rgba(217, 104, 80, 0.08)",
            borderWidth: 2,
            tension: 0.3,
            pointRadius: 0,
            yAxisID: "y1",
          },
          {
            type: "bar",
            label: "New signups",
            data: dailyData,
            backgroundColor: "rgba(107, 179, 138, 0.55)",
            borderRadius: 3,
            yAxisID: "y",
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { mode: "index", intersect: false },
        plugins: {
          legend: {
            labels: { color: "#9ba1ac", font: { size: 11 } },
          },
        },
        scales: {
          x: {
            ticks: {
              color: "#6b7280",
              maxRotation: 0,
              autoSkip: true,
              maxTicksLimit: 10,
            },
            grid: { color: "rgba(255,255,255,0.03)" },
          },
          y: {
            position: "left",
            ticks: { color: "#6b7280" },
            grid: { color: "rgba(255,255,255,0.03)" },
            title: {
              display: true,
              text: "New signups",
              color: "#6b7280",
              font: { size: 10 },
            },
          },
          y1: {
            position: "right",
            ticks: { color: "#6b7280" },
            grid: { drawOnChartArea: false },
            title: {
              display: true,
              text: "Total users",
              color: "#6b7280",
              font: { size: 10 },
            },
          },
        },
      },
    });
  }

  async function fetchData() {
    try {
      const data = await API.getPublicGrowth();
      latestData = data;
      return data;
    } catch (error) {
      console.error("Error loading growth data:", error);
      return null;
    }
  }

  await fetchData();

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting && !hasAnimatedIn && latestData) {
          hasAnimatedIn = true;
          currentTotal = 0;
          animateCountTo(latestData.total_users, 1500);
          buildChart(latestData);
          observer.unobserve(section);
        }
      });
    },
    { threshold: 0.3 },
  );
  observer.observe(section);

  setInterval(async () => {
    if (!hasAnimatedIn) return;
    const data = await fetchData();
    if (data) bumpTotal(data.total_users);
  }, 30000);
});
