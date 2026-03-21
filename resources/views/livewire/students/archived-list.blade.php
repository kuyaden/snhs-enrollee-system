<div class="p-6 space-y-6">
    {{-- ✅ Flash message --}}
    @if (session('success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 border border-green-300 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/10 dark:to-amber-900/10 p-6 rounded-2xl border border-orange-100 dark:border-orange-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-orange-500 rounded-xl shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m12 6l6-6m-6-6l6 6M4 6h16M4 18h16" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Archived Students</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Manage students removed from active enrollment</p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-1 bg-white dark:bg-gray-800 px-3 py-1 rounded-full border border-orange-200 dark:border-orange-800">
                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                    <span>{{ $students->total() }} Archived</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters Section --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Search --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search archived students</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                           wire:model.live.debounce.300ms="search"
                           class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-300 dark:border-gray-600 
                                  bg-white dark:bg-gray-800 text-gray-900 dark:text-white 
                                  focus:ring-2 focus:ring-orange-500 focus:border-transparent shadow-sm transition-all duration-200"
                           placeholder="Search by name or LRN..." />
                </div>
            </div>

            {{-- Grade Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Grade Level</label>
                <flux:dropdown class="w-full">
                    <flux:button class="inline-flex items-center justify-between gap-2 w-full h-11 px-4 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                        <span class="truncate">
                            {{ $filterGrade ? "Grade $filterGrade" : 'All Grades' }}
                        </span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </flux:button>
                    <flux:menu class="w-64 max-w-full">
                        <flux:menu.item wire:click="$set('filterGrade', '')" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            All Grades
                        </flux:menu.item>
                        <flux:menu.separator />
                        @foreach ($availableGrades as $grade)
                            <flux:menu.item wire:click="$set('filterGrade', '{{ $grade }}')" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Grade {{ $grade }}
                            </flux:menu.item>
                        @endforeach
                    </flux:menu>
                </flux:dropdown>
            </div>

            {{-- Barangay Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Barangay</label>
                <flux:dropdown class="w-full">
                    <flux:button class="inline-flex items-center justify-between gap-2 w-full h-11 px-4 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                        <span class="truncate">
                            {{ $filterBarangay ? $filterBarangay : 'All Barangays' }}
                        </span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </flux:button>
                    <flux:menu class="w-64 max-w-full">
                        <flux:menu.item wire:click="$set('filterBarangay', '')" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            All Barangays
                        </flux:menu.item>
                        <flux:menu.separator />
                        @foreach ($availableBarangays as $barangay)
                            <flux:menu.item wire:click="$set('filterBarangay', '{{ $barangay }}')" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $barangay }}
                            </flux:menu.item>
                        @endforeach
                    </flux:menu>
                </flux:dropdown>
            </div>
        </div>
    </div>

    {{-- Archived Students Table --}}
    @if ($students->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-12 text-center">
            <div class="max-w-md mx-auto">
                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m12 6l6-6m-6-6l6 6M4 6h16M4 18h16" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No archived students found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Try adjusting your search criteria or filters</p>
                <button wire:click="$set('search', '')" class="inline-flex items-center gap-2 px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset Filters
                </button>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Student</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Gender</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Grade</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Location</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">LRN</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($students as $student)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="relative">
                                            @if ($student->profile_image)
                                                <img src="{{ Storage::url($student->profile_image) }}"
                                                     alt="Student Photo"
                                                     class="w-10 h-10 rounded-xl object-cover border-2 border-white dark:border-gray-800 shadow-sm">
                                            @else
                                                <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                                                {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Archived</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $student->sex === 'Male' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-pink-100 text-pink-800 dark:bg-pink-900/30 dark:text-pink-300' }}">
                                        {{ $student->sex }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300">
                                        Grade {{ $student->grade_level }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>{{ $student->barangay }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400 font-mono text-sm">
                                    {{ $student->lrn }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button wire:click="restore({{ $student->id }})"
                                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 transition-all duration-200 shadow-sm group/restore">
                                            <svg class="w-4 h-4 group-hover/restore:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                            </svg>
                                            Restore
                                        </button>

                                        <button wire:click="confirmDelete({{ $student->id }})"
                                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-xl hover:bg-red-700 transition-all duration-200 shadow-sm group/delete">
                                            <svg class="w-4 h-4 group-hover/delete:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination & Stats --}}
        <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} archived students
            </div>
            <div class="flex items-center space-x-2">
                {{ $students->links() }}
            </div>
        </div>

        {{-- Total Deleted Count --}}
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-red-100 dark:bg-red-800 rounded-lg">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-red-800 dark:text-red-300">Permanently Deleted Students</p>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $totalDeleted }}</p>
                    </div>
                </div>
                <div class="text-xs text-red-600 dark:text-red-400">
                    This action cannot be undone
                </div>
            </div>
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    @if ($studentToDelete)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity duration-300">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 w-full max-w-md mx-4 animate-[fadeIn_0.3s_ease-out] border border-red-200 dark:border-red-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-red-100 dark:bg-red-900 rounded-lg">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Confirm Permanent Deletion</h2>
                </div>
                
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Are you sure you want to permanently delete <span class="font-semibold text-gray-900 dark:text-white">{{ $studentToDelete->last_name }}, {{ $studentToDelete->first_name }}</span>? 
                    <br><br>
                    <span class="text-red-600 dark:text-red-400 font-semibold">This action cannot be undone and all student data will be permanently lost.</span>
                </p>

                <div class="flex justify-end space-x-3">
                    <button wire:click="cancelDelete"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition-all duration-200">
                        Cancel
                    </button>

                    <button wire:click="delete"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-xl hover:bg-red-700 transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Permanently
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>