<div class="w-full bg-white dark:bg-neutral-900 rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-lg hover:border hover:border-gray-200 dark:hover:border-neutral-700">
  <!-- Header -->
  <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 flex items-center space-x-2">
    <i class="bi bi-bar-chart-fill text-pink-400"></i>
    <span>Students per Grade Level</span>
  </h2>

  <!-- Chart Container -->
  <div class="w-full h-72 relative">
    <canvas id="gradeChart" class="absolute inset-0 w-full h-full"></canvas>
  </div>

  <script>
    let gradeChart;

    function renderGradeChart() {
      const ctx = document.getElementById('gradeChart').getContext('2d');
      const isDark = document.documentElement.classList.contains('dark');

      if (gradeChart) gradeChart.destroy();

      // 🎨 Soft pastel palette for grade bars
      const pastelColors = [
        'rgba(255, 179, 186, 0.7)', // pastel pink
        'rgba(255, 223, 186, 0.7)', // pastel peach
        'rgba(255, 255, 186, 0.7)', // pastel yellow
        'rgba(186, 255, 201, 0.7)', // pastel mint
        'rgba(186, 225, 255, 0.7)', // pastel blue
        'rgba(218, 186, 255, 0.7)', // pastel lavender
      ];

      gradeChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: @json($chartLabels),
          datasets: [{
            label: 'Number of Students',
            data: @json($chartData),
            backgroundColor: pastelColors,
            borderColor: pastelColors.map(c => c.replace('0.7', '1')),
            borderRadius: 8, // rounded bar edges
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            title: {
              display: true,
              text: 'Distribution of Students Across Grade Levels',
              color: isDark ? '#f3f4f6' : '#1f2937',
              font: { size: 14, weight: '600' },
              padding: { bottom: 15 }
            },
            tooltip: {
              backgroundColor: isDark ? '#1f2937' : '#f9fafb',
              titleColor: isDark ? '#f3f4f6' : '#111827',
              bodyColor: isDark ? '#d1d5db' : '#374151',
              borderColor: isDark ? '#374151' : '#e5e7eb',
              borderWidth: 1
            }
          },
          scales: {
            x: {
              ticks: { color: isDark ? '#f3f4f6' : '#374151', font: { size: 12 } },
              grid: { display: false }
            },
            y: {
              beginAtZero: true,
              ticks: { stepSize: 1, color: isDark ? '#f3f4f6' : '#374151' },
              grid: { color: isDark ? '#374151' : '#e5e7eb' }
            }
          }
        }
      });
    }

    renderGradeChart();
    new MutationObserver(renderGradeChart).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
  </script>
</div>
