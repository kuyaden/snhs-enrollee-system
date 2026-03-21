<x-layouts.app :title="__('Dashboard')">
  <div class="p-6 space-y-8">

    <!-- Header with Export Button -->
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Dashboard</h2>
        <div>
            @livewire('exports.students-pdf-export')
        </div>
    </div>

    <!-- Top Cards -->
    <div class="flex flex-row space-x-5">
        @livewire('charts.total-students')
        @livewire('charts.total-barangay')
        @livewire('charts.total-users')
        @livewire('charts.total-archived-students')
    </div>

    <!-- Middle Row (Gender + Grade Distribution) -->
    <div class="h-100 grid grid-cols-1 md:grid-cols-1 xl:grid-cols-3 gap-6">
        @livewire('charts.gender-chart')
        @livewire('charts.grade-chart')
        @livewire('charts.barangay-chart')
    </div>

    <!-- Lower Row (Recent Registrations + Enrollment Status) -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        @livewire('charts.recent-registrations')
        @livewire('charts.enrollment-status-chart')
    </div>

    <!-- Bottom (Yearly Trends) -->
    <div>
        @livewire('charts.yearly-enrollment-chart')
    </div>

  </div>
</x-layouts.app>
