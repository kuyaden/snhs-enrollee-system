<div class="w-64 md:w-1/4 
            bg-white dark:bg-gray-800 
            border-l-4 border-pink-500
            rounded-lg shadow-sm hover:shadow-md transition duration-300">

    <!-- Card Body -->
    <div class="p-4 flex items-center space-x-4">
        
        <!-- Icon -->
        <div class="flex items-center justify-center w-12 h-12 rounded-md bg-pink-100 text-pink-600 text-2xl">
            <i class="bi bi-journal-bookmark"></i>
        </div>

        <!-- Text -->
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">
                Total Students Enrolled
            </p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                {{ $totalStudents }}
            </h3>
        </div>
    </div>

    <!-- Customized Footer -->
    <div class="px-4 py-2 bg-gray-50 dark:bg-gray-900 
                border-t border-pink-200 dark:border-pink-700 
                text-xs text-gray-500 dark:text-gray-400">
        School Year 2024–2025 • As of {{ now()->format('M d, Y') }}
    </div>
</div>
