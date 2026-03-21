<div class="w-full bg-white dark:bg-neutral-900 rounded-xl shadow-lg p-6 flex flex-col space-y-4 transition-all duration-300 hover:shadow-xl hover:border hover:border-blue-200 relative">
  <!-- Header -->
  <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
    <i class="bi bi-pie-chart-fill text-blue-500"></i>
    Enrollment Status Overview
  </h2>

  <!-- Chart Container -->
  <div class="w-full h-72 relative flex items-center justify-center">
    <canvas id="enrollmentStatusChart" class="w-full h-full"></canvas>

  </div>

  <script>
    let enrollmentStatusChart;

    function renderEnrollmentStatusChart() {
      const canvas = document.getElementById('enrollmentStatusChart');
      if (!canvas) return;
      const ctx = canvas.getContext('2d');
      const isDark = document.documentElement.classList.contains('dark');

      if (enrollmentStatusChart) enrollmentStatusChart.destroy();

      // Pastel colors (softer, modern look)
      const pastelColors = [
        '#A7F3D0', // mint green
        '#FCD34D', // soft yellow
        '#FCA5A5', // pastel red
        '#C4B5FD', // pastel violet
        '#BFDBFE'  // pastel blue
      ];

      enrollmentStatusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: @json($chartLabels),
          datasets: [{
            label: 'Enrollment Status',
            data: @json($chartData),
            backgroundColor: pastelColors,
            borderColor: isDark ? '#1f2937' : '#fff',
            borderWidth: 2,
            cutout: '72%' // thinner donut
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                padding: 20,
                usePointStyle: true,
                pointStyle: 'circle',
                color: isDark ? '#f3f4f6' : '#1f2937',
                font: { size: 12 }
              }
            },
            title: {
              display: false 
            },
            tooltip: {
              backgroundColor: isDark ? '#1f2937' : '#fff',
              titleColor: isDark ? '#f3f4f6' : '#1f2937',
              bodyColor: isDark ? '#f3f4f6' : '#1f2937',
              borderColor: '#e5e7eb',
              borderWidth: 1
            }
          },
          animation: {
            animateRotate: true,
            animateScale: true
          }
        }
      });
    }

    document.addEventListener('DOMContentLoaded', renderEnrollmentStatusChart);
    new MutationObserver(renderEnrollmentStatusChart).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
    document.addEventListener('livewire:load', () => {
      Livewire.hook('message.processed', renderEnrollmentStatusChart);
    });
  </script>
</div>
