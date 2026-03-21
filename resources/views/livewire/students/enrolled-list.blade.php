<div class="space-y-8">
    {{--  Toast Notification (Alpine.js) --}}
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition
            class="fixed top-4 right-4 z-50 bg-green-100 border border-green-300 text-green-800 
                   dark:bg-green-900 dark:text-green-200 dark:border-green-700 
                   rounded-lg px-4 py-3 shadow-lg text-sm max-w-sm w-full backdrop-blur-sm"
        >
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-600 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" 
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11.414V14a1 1 0 
                             11-2 0V6.586L7.707 8.293a1 1 0 
                             11-1.414-1.414l3.999-4a1 1 0 
                             011.414 0l4 4a1 1 0 
                             11-1.414 1.414L11 6.586z" 
                          clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900 p-6 rounded-2xl border border-blue-100 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-blue-500 rounded-xl shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Enrolled Students</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Manage and view all enrolled students in the system</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <flux:button 
                    as="a" 
                    href="{{ route('add.students') }}" 
                    variant="primary" 
                    class="!px-4 !py-2.5 bg-blue-600 hover:bg-blue-700 border-0 rounded-lg font-semibold shadow-sm transition-all duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Student
                </flux:button>

                <flux:button
                    as="a"
                    href="{{ route('students.export', [
                        'year' => $filterYear,
                        'grade' => $filterGrade,
                        'barangay' => $filterBarangay,
                        'sex' => $filterSex,
                    ]) }}"
                    variant="ghost"
                    class="p-2.5 rounded-xl bg-green-50 hover:bg-green-100 dark:bg-green-900/30 dark:hover:bg-green-900/50 border border-green-200 dark:border-green-800 transition-all duration-200 group"
                    title="Export to Excel"
                >
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </flux:button>
            </div>
        </div>
    </div>

    {{-- Search and Filters Section --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="flex flex-wrap items-end gap-4">
            {{-- Search Input --}}
            <div class="relative w-full md:w-1/3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="w-full h-11 pl-10 pr-4 border text-sm border-gray-300 dark:border-gray-600 
                        rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                        shadow-sm transition-all duration-200 capitalize"  
                    placeholder="Search students by name, LRN, or barangay..." />
            </div>

            {{-- Grade Filter --}}
            <div class="w-full md:w-auto">
                <label for="filterGrade" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Grade Level</label>
                <select id="filterGrade" wire:model.live="filterGrade"
                    class="w-full h-11 px-3 text-sm border-gray-300 dark:border-gray-600 
                           rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           dark:bg-gray-800 dark:text-white bg-white border transition-all duration-200">
                    <option value="">All Grades</option>
                    @foreach ($availableGrades as $grade)
                        <option value="{{ $grade }}">Grade {{ $grade }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Barangay Filter --}}
            <div class="w-full md:w-auto">
                <label for="filterBarangay" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Barangay</label>
                <select id="filterBarangay" wire:model.live="filterBarangay"
                    class="w-full h-11 px-3 text-sm border-gray-300 dark:border-gray-600 
                           rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           dark:bg-gray-800 dark:text-white bg-white border transition-all duration-200">
                    <option value="">All Barangays</option>
                    @foreach ($availableBarangays as $barangay)
                        <option value="{{ $barangay }}">{{ $barangay }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Sex Filter --}}
            <div class="w-full md:w-auto">
                <label for="filterSex" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gender</label>
                <select id="filterSex" wire:model.live="filterSex"
                    class="w-full h-11 px-3 text-sm border-gray-300 dark:border-gray-600 
                           rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           dark:bg-gray-800 dark:text-white bg-white border transition-all duration-200">
                    <option value="">All Genders</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            {{-- Academic Year Filter --}}
            <div class="w-full md:w-auto">
                <label for="filterYear" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Academic Year
                </label>
                <select id="filterYear" wire:model.live="filterYear"
                    class="w-full h-11 px-3 text-sm border-gray-300 dark:border-gray-600 
                           rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           dark:bg-gray-800 dark:text-white bg-white border transition-all duration-200">
                    <option value="">All Years</option>
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Student Information</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Grade</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Location</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">LRN</th>
                        <th class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($students as $student)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                            {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Student</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $student->sex === 'Male' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-pink-100 text-pink-800 dark:bg-pink-900/30 dark:text-pink-300' }}">
                                    {{ $student->sex }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
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
                            <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-400">{{ $student->lrn }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('students.enrolled.show', $student->id) }}"
                                       class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-all duration-200 shadow-sm group/view">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('students.enrolled.edit', $student->id) }}"
                                       class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-sm group/edit">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <flux:modal.trigger name="delete-student" wire:click="setStudentToDelete({{ $student->id }})">
                                        <button
                                            class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all duration-200 shadow-sm group/delete">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </flux:modal.trigger>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3 text-gray-400 dark:text-gray-500">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p class="text-lg font-medium">No students found</p>
                                    <p class="text-sm">Try adjusting your search or filters</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} results
        </div>
        <div class="flex items-center space-x-2">
            {{ $students->links() }}
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <flux:modal name="delete-student" class="min-w-[28rem] rounded-2xl">
        <div class="space-y-6 p-6">
            <div class="text-center">
                <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-2xl inline-flex mb-4">
                    <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <flux:heading size="lg" class="text-red-600 dark:text-red-400">Delete Student?</flux:heading>
                <flux:text class="mt-2 text-gray-600 dark:text-gray-400">
                    <p>Are you sure you want to delete this student record?</p>
                    <p class="mt-1 text-sm">This action cannot be undone and all associated data will be permanently removed.</p>
                </flux:text>
            </div>
            <div class="flex gap-3 justify-center">
                <flux:modal.close>
                    <flux:button variant="ghost" class="!px-6 border border-gray-300 dark:border-gray-600">Cancel</flux:button>
                </flux:modal.close>
                <flux:modal.close>
                    <flux:button variant="danger" wire:click="deleteConfirmed" class="!px-6 bg-red-600 hover:bg-red-700 border-0">
                        Delete Student
                    </flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>