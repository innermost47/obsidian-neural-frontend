document.addEventListener("DOMContentLoaded", async () => {
  const totalEl = document.getElementById("growth-total-users");
  const canvas = document.getElementById("growth-chart");
  if (!totalEl || !canvas) return;

  try {
    const data = await API.getPublicGrowth();

    totalEl.textContent = data.total_users.toLocaleString();

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

    new Chart(canvas, {
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
  } catch (error) {
    console.error("Error loading growth data:", error);
    totalEl.textContent = "—";
  }
});
