<div class="w-full bg-white dark:bg-neutral-900 rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl border border-gray-100 dark:border-neutral-800">
  
  <!-- Header -->
  <div class="flex items-center justify-between mb-6">
    <div class="chart-title">
      <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2">
        <i class="bi bi-graph-up-arrow text-blue-500"></i>
        Enrollment Trends & Forecast
      </h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Actual vs. Forecasted Enrollment</p>
    </div>
    
    <!-- Actions -->
    <div class="chart-actions flex gap-2">
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="stats-container grid grid-cols-3 gap-4 mb-6">
    <div class="stat-card bg-blue-50 dark:bg-blue-900/10 border-blue-100 dark:border-blue-800">
      <div class="stat-header">
        <span class="stat-title text-blue-700 dark:text-blue-300">Current Enrollment</span>
        <div class="stat-icon bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300">
          <i class="bi bi-people"></i>
        </div>
      </div>
      <span class="stat-value text-blue-800 dark:text-blue-200">
        @php echo is_array($chartData) && !empty($chartData) ? end($chartData) : 0; @endphp
      </span>
      <div class="stat-trend trend-up">
        <i class="bi bi-arrow-up-right"></i>
        <span>Current Year</span>
      </div>
    </div>
    
    <div class="stat-card bg-amber-50 dark:bg-amber-900/10 border-amber-100 dark:border-amber-800">
      <div class="stat-header">
        <span class="stat-title text-amber-700 dark:text-amber-300">Next Year Forecast</span>
        <div class="stat-icon bg-amber-100 dark:bg-amber-800 text-amber-600 dark:text-amber-300">
          <i class="bi bi-graph-up"></i>
        </div>
      </div>
      <span class="stat-value text-amber-800 dark:text-amber-200">
        @php echo is_array($forecastData) && !empty($forecastData) ? end($forecastData) : 0; @endphp
      </span>
      <div class="stat-trend trend-up">
        <i class="bi bi-lightning"></i>
        <span>Predictor Adjusted</span>
      </div>
    </div>
    
    <div class="stat-card bg-green-50 dark:bg-green-900/10 border-green-100 dark:border-green-800">
      <div class="stat-header">
        <span class="stat-title text-green-700 dark:text-green-300">Projected Growth</span>
        <div class="stat-icon bg-green-100 dark:bg-green-800 text-green-600 dark:text-green-300">
          <i class="bi bi-arrow-up-right"></i>
        </div>
      </div>
      <span class="stat-value text-green-800 dark:text-green-200">
        @php
          $current = is_array($chartData) && !empty($chartData) ? end($chartData) : 0;
          $forecast = is_array($forecastData) && !empty($forecastData) ? end($forecastData) : 0;
          $growth = 0;
          if ($current > 0) {
            $growth = (($forecast - $current) / $current) * 100;
          }
          echo $growth != 0 ? round($growth, 1) . '%' : '0%';
        @endphp
      </span>
      <div class="stat-trend trend-up">
        <i class="bi bi-graph-up-arrow"></i>
        <span>Year over Year</span>
      </div>
    </div>
  </div>

  <!-- Chart -->
  <div class="chart-wrapper w-full h-72 relative">
    <canvas id="yearlyEnrollmentChart" class="absolute inset-0 w-full h-full"></canvas>
  </div>

  <!-- Footer -->
  <div class="chart-footer flex justify-between items-center mt-4 pt-4 border-t border-gray-200 dark:border-neutral-700">
    <div class="legend flex gap-4">
      <div class="legend-item flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
        <div class="legend-color w-3 h-3 rounded bg-blue-500"></div>
        <span>Actual Enrollment</span>
      </div>
      <div class="legend-item flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
        <div class="legend-color w-3 h-3 rounded bg-amber-500 border-2 border-dashed border-amber-500"></div>
        <span>Forecast</span>
      </div>
    </div>
    <div class="forecast-note text-xs text-gray-500 dark:text-gray-400 text-right max-w-xs">
      Predictive model based on historical trends and demographic factors
    </div>
  </div>

  <style>
    .chart-title h2 {
      font-size: 1.25rem;
      font-weight: 600;
    }
    
    .chart-actions {
      display: flex;
      gap: 8px;
    }
    
    .action-btn {
      background: rgba(255, 255, 255, 0.7);
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 6px 12px;
      display: flex;
      align-items: center;
      gap: 4px;
      font-size: 0.875rem;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .dark .action-btn {
      background: rgba(55, 65, 81, 0.5);
      border-color: #374151;
      color: #d1d5db;
    }
    
    .action-btn:hover {
      transform: translateY(-1px);
    }
    
    .theme-toggle {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .stats-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
    }
    
    .stat-card {
      background: rgba(255, 255, 255, 0.6);
      border-radius: 12px;
      padding: 16px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      transition: all 0.3s ease;
    }
    
    .dark .stat-card {
      background: rgba(55, 65, 81, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .stat-card:hover {
      transform: translateY(-2px);
    }
    
    .stat-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
    }
    
    .stat-title {
      font-size: 0.75rem;
      font-weight: 500;
    }
    
    .stat-icon {
      width: 28px;
      height: 28px;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
    }
    
    .stat-value {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 4px;
    }
    
    .stat-trend {
      display: flex;
      align-items: center;
      gap: 4px;
      font-size: 0.7rem;
      font-weight: 600;
    }
    
    .trend-up {
      color: #10b981;
    }
    
    .legend-item {
      display: flex;
      align-items: center;
      gap: 6px;
    }
    
    .forecast-note {
      font-size: 0.75rem;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .stats-container {
        grid-template-columns: 1fr;
      }
      
      .chart-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
      
      .chart-actions {
        width: 100%;
        justify-content: space-between;
      }
      
      .chart-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
      
      .forecast-note {
        text-align: left;
      }
    }
  </style>

  <script>
    let yearlyChart;

    function renderYearlyEnrollmentChart() {
      const canvas = document.getElementById('yearlyEnrollmentChart');
      if (!canvas) return;
      
      const ctx = canvas.getContext('2d');
      const isDark = document.documentElement.classList.contains('dark');

      if (yearlyChart) yearlyChart.destroy();

      // Color scheme that matches your dashboard
      const colors = {
        actualBar: isDark ? 'rgba(79, 70, 229, 0.8)' : 'rgba(99, 102, 241, 0.8)',
        forecastLine: isDark ? '#F59E0B' : '#D97706',
        forecastPoint: isDark ? '#FBBF24' : '#F59E0B',
        grid: isDark ? 'rgba(55, 65, 81, 0.3)' : 'rgba(229, 231, 235, 0.8)'
      };

      yearlyChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: @json($forecastLabels ?: $chartLabels),
          datasets: [
            {
              label: 'Actual Enrollment',
              data: @json($chartData),
              backgroundColor: colors.actualBar,
              borderRadius: 4,
              borderWidth: 0,
              barPercentage: 0.5,
              categoryPercentage: 0.6,
            },
            {
              label: 'Forecast',
              data: @json($forecastData),
              type: 'line',
              borderColor: colors.forecastLine,
              borderWidth: 2,
              borderDash: [5, 5],
              pointBackgroundColor: colors.forecastPoint,
              pointBorderColor: isDark ? '#1f2937' : '#ffffff',
              pointBorderWidth: 2,
              pointRadius: 3,
              pointHoverRadius: 5,
              tension: 0.3,
              fill: false
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: { 
            duration: 800, 
            easing: 'easeOutQuart' 
          },
          interaction: {
            mode: 'index',
            intersect: false
          },
          plugins: {
            legend: { 
              display: false
            },
            tooltip: {
              backgroundColor: isDark ? '#1f2937' : '#ffffff',
              titleColor: isDark ? '#f9fafb' : '#1f2937',
              bodyColor: isDark ? '#d1d5db' : '#4b5563',
              borderColor: isDark ? '#374151' : '#e5e7eb',
              borderWidth: 1,
              padding: 8,
              cornerRadius: 6,
              usePointStyle: true,
              displayColors: true,
              callbacks: {
                label: function(context) {
                  return `${context.dataset.label}: ${context.parsed.y.toLocaleString()} students`;
                }
              }
            }
          },
          scales: {
            x: {
              grid: { 
                color: colors.grid,
                drawBorder: false
              },
              ticks: { 
                color: isDark ? '#9ca3af' : '#6b7280', 
                font: { size: 11 }
              }
            },
            y: {
              beginAtZero: true,
              grid: { 
                color: colors.grid,
                drawBorder: false
              },
              ticks: { 
                color: isDark ? '#9ca3af' : '#6b7280', 
                font: { size: 11 },
                callback: function(value) {
                  return value.toLocaleString();
                }
              }
            }
          }
        }
      });
    }

    // Initialize chart
    document.addEventListener('DOMContentLoaded', renderYearlyEnrollmentChart);
    
    // Watch for theme changes
    new MutationObserver(renderYearlyEnrollmentChart).observe(
      document.documentElement, 
      { attributes: true, attributeFilter: ['class'] }
    );
    
    // Livewire hooks
    document.addEventListener('livewire:load', () => {
      setTimeout(renderYearlyEnrollmentChart, 100);
      Livewire.hook('message.processed', () => {
        setTimeout(renderYearlyEnrollmentChart, 100);
      });
    });
  </script>
</div>