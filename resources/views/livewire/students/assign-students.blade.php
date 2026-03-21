<div class="p-6 space-y-6">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/10 dark:to-indigo-900/10 p-6 rounded-2xl border border-blue-100 dark:border-blue-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-blue-500 rounded-xl shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Assign Students</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Select a section and assign unassigned students to it</p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-1 bg-white dark:bg-gray-800 px-3 py-1 rounded-full border border-blue-200 dark:border-blue-800">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span>{{ $students->total() }} Unassigned</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Back Button --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('students.section-manager') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Sections
        </a>
    </div>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="flex items-center gap-3 p-4 text-sm text-green-800 bg-green-100 border border-green-300 rounded-xl dark:text-green-400 dark:bg-green-900/20 dark:border-green-800">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    {{-- Assign Students Form --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Assignment Details</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Select section and students to assign</p>
        </div>
        
        <form wire:submit.prevent="assignStudents" class="p-6 space-y-6">
            {{-- Section Selection --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Choose Section</label>
                <flux:select wire:model="selectedSectionId" class="w-full rounded-xl border-gray-300 dark:border-gray-600 h-11">
                    <option value="">-- Select Section --</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">
                            Grade {{ $section->grade_level }} - {{ $section->name }}
                        </option>
                    @endforeach
                </flux:select>
            </div>

            {{-- Filters Section --}}
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Filter Students</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Search --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Search Students</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" 
                                   wire:model.live.debounce.300ms="search"
                                   class="w-full h-10 pl-10 pr-4 rounded-lg border border-gray-300 dark:border-gray-600 
                                          bg-white dark:bg-gray-800 text-gray-900 dark:text-white 
                                          focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition-all duration-200"
                                   placeholder="Search students by name..." />
                        </div>
                    </div>

                    {{-- Grade Filter --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Grade Level</label>
                        <select wire:model.live="filterGrade"
                                class="w-full h-10 px-4 rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-white dark:bg-gray-800 text-gray-900 dark:text-white 
                                       focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition-all duration-200">
                            <option value="">-- All Grade Levels --</option>
                            @foreach(range(7,12) as $grade)
                                <option value="{{ $grade }}">Grade {{ $grade }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Students Selection --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Unassigned Students</h4>
                    <div class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
                        {{ count($selectedStudents) }} selected
                    </div>
                </div>

                @if($students->count())
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-600">
                                    <tr>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider w-12">
                                            <input type="checkbox" 
                                                   wire:model="selectAll"
                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                                        </th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">Grade</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">LRN</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($students as $student)
                                        <tr wire:key="student-{{ $student->id }}" 
                                            class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                                            <td class="px-6 py-4">
                                                <input type="checkbox" 
                                                       wire:model="selectedStudents" 
                                                       value="{{ $student->id }}" 
                                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                                            {{ $student->last_name }}, {{ $student->first_name }}
                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $student->middle_name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                                    Grade {{ $student->grade_level }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400 font-mono text-sm">
                                                {{ $student->lrn ?? '—' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} students
                        </div>
                        <div class="flex items-center space-x-2">
                            {{ $students->links() }}
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-8 text-center">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No unassigned students available.</p>
                    </div>
                @endif
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
                <flux:button type="submit" class="px-6 py-3" variant="primary" color="blue">
                    {{-- <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg> --}}
                    Assign Students
                </flux:button>
            </div>
        </form>
    </div>
</div>