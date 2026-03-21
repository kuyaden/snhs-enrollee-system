<div 
    x-data="{ 
        femalePercent: {{ $femalePercent }}, 
        malePercent: {{ $malePercent }}, 
        femaleCount: {{ $femaleCount }}, 
        maleCount: {{ $maleCount }} 
    }" 
    class="w-full bg-white/80 dark:bg-neutral-900/80 rounded-2xl shadow-lg border border-gray-100 dark:border-neutral-700 p-6 transition-all duration-300 hover:shadow-xl backdrop-blur-sm"
>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">Students Ratio</h2>
        <i class="fas fa-users text-gray-400 text-xl"></i>
    </div>

    <div class="flex items-center justify-around gap-10">
        <!-- Female -->
        <div class="flex flex-col items-center text-center space-y-3">
            <!-- Female Bar -->
            <div class="relative w-20 h-36 bg-gradient-to-b from-pink-100 to-pink-50 rounded-xl overflow-hidden shadow-inner border border-pink-200/70">
                <div class="absolute bottom-0 w-full bg-gradient-to-t from-pink-400 to-pink-300 transition-all duration-700"
                     :style="{ height: femalePercent + '%' }"></div>
            </div>

            <!-- Female Stats -->
            <i class="fas fa-female text-4xl text-pink-400 mt-2"></i>
            <p class="text-2xl font-extrabold text-pink-500" x-text="femalePercent + '%'"></p>
            <p class="text-gray-500 text-sm">
                <span class="font-semibold text-pink-600" x-text="femaleCount"></span> Students
            </p>
        </div>

        <!-- Divider with VS -->
        <div class="flex flex-col items-center">
            <div class="h-28 w-px bg-gradient-to-b from-gray-100 to-gray-300 dark:from-neutral-700 dark:to-neutral-600"></div>
            <p class="mt-2 text-xs font-bold text-gray-400">VS</p>
        </div>

        <!-- Male -->
        <div class="flex flex-col items-center text-center space-y-3">
            <!-- Male Bar -->
            <div class="relative w-20 h-36 bg-gradient-to-b from-blue-100 to-blue-50 rounded-xl overflow-hidden shadow-inner border border-blue-200/70">
                <div class="absolute bottom-0 w-full bg-gradient-to-t from-blue-400 to-blue-300 transition-all duration-700"
                     :style="{ height: malePercent + '%' }"></div>
            </div>

            <!-- Male Stats -->
            <i class="fas fa-male text-4xl text-blue-400 mt-2"></i>
            <p class="text-2xl font-extrabold text-blue-500" x-text="malePercent + '%'"></p>
            <p class="text-gray-500 text-sm">
                <span class="font-semibold text-blue-600" x-text="maleCount"></span> Students
            </p>
        </div>
    </div>
</div>
