<div class="w-64 md:w-1/4 
            bg-white dark:bg-gray-800 
            border-l-4 border-green-500 
            rounded-lg shadow-sm hover:shadow-md transition duration-300">

    <!-- Card Body -->
    <div class="p-4 flex items-center space-x-4">
        
        <!-- Icon -->
        <div class="flex items-center justify-center w-12 h-12 rounded-md bg-green-100 text-green-600 text-2xl">
            <i class="bi bi-archive"></i>
        </div>

        <!-- Text -->
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">
                Total Barangay
            </p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                {{ $totalBarangay }}
            </h3>
        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 py-2 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
        As of {{ now()->format('M d, Y') }}
    </div>
</div>
