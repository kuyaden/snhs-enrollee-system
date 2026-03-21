<div class="w-full bg-white dark:bg-neutral-900 rounded-2xl shadow-md p-6 flex flex-col space-y-5 transition-all duration-300 hover:shadow-xl hover:border hover:border-blue-200/50">
  <!-- Title -->
  <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
    <i class="fas fa-map-marker-alt text-pink-400"></i> 
    Enrollment by Barangay
  </h2>

  <!-- Chart -->
  <div class="w-full h-72 relative">
    <canvas id="barangayChart" class="absolute inset-0 w-full h-full"></canvas>
  </div>

  <script>
    let barangayChart;

    function renderBarangayChart() {
      const canvas = document.getElementById('barangayChart');
      if (!canvas) return;
      const ctx = canvas.getContext('2d');
      const isDark = document.documentElement.classList.contains('dark');

      if (barangayChart) barangayChart.destroy();

      barangayChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: @json($chartLabels),
          datasets: [{
            label: 'No. of Students',
            data: @json($chartData),
            backgroundColor: [
              '#FFB5E8', '#B5DEFF', '#C7FFD8', '#FFDAC1', '#E2F0CB',
              '#FFABAB', '#D5AAFF', '#FBC1FF', '#FFFFB5', '#B5FFD9'
            ],
            borderRadius: 12,
            borderSkipped: false,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            title: {
              display: true,
              text: 'Enrollment by Barangay',
              color: isDark ? '#f3f4f6' : '#1f2937',
              font: { size: 16, weight: 'bold' }
            },
            tooltip: {
              backgroundColor: isDark ? '#374151' : '#ffffff',
              titleColor: isDark ? '#f3f4f6' : '#1f2937',
              bodyColor: isDark ? '#d1d5db' : '#4b5563',
              borderColor: isDark ? '#4b5563' : '#e5e7eb',
              borderWidth: 1,
              padding: 10,
              displayColors: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                color: isDark ? '#f3f4f6' : '#374151',
                font: { size: 12 }
              },
              grid: {
                color: isDark ? '#374151' : '#E5E7EB',
                borderDash: [4, 4]
              }
            },
            x: {
              ticks: {
                color: isDark ? '#f3f4f6' : '#374151',
                font: { size: 12 }
              },
              grid: { display: false }
            }
          }
        }
      });
    }

    renderBarangayChart();
    new MutationObserver(renderBarangayChart).observe(
      document.documentElement, 
      { attributes: true, attributeFilter: ['class'] }
    );
  </script>
</div>
