<div class="max-w-6xl mx-auto p-8 bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-gray-200 dark:border-zinc-700 space-y-8">

    {{-- Header with Profile and School Logo --}}
    <div class="flex flex-col lg:flex-row items-center justify-between gap-8 pb-8 border-b border-gray-200 dark:border-zinc-700">
        {{-- Student Profile Section --}}
        <div class="flex flex-col sm:flex-row items-center gap-6">
            {{-- Profile Image with Gradient Border --}}
            <div class="relative">
                @php
                    $profileImagePath = $student->profile_image
                        ? asset('storage/' . $student->profile_image)
                        : asset('images/default-avatar.png');
                @endphp
                <div class="relative">
                    <img src="{{ $profileImagePath }}"
                         alt="Profile Image"
                         class="w-32 h-32 rounded-2xl object-cover shadow-lg border-4 border-white dark:border-zinc-800" />
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-blue-500/10 to-purple-600/10"></div>
                </div>
                <div class="absolute -bottom-2 -right-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                    Student
                </div>
            </div>

            {{-- Student Information --}}
            <div class="text-center sm:text-left">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
                    {{ $student->first_name }}
                    {{ $student->middle_name }}
                    {{ $student->last_name }}
                    {{ $student->extension_name ?? '' }}
                </h1>
                <div class="flex items-center justify-center sm:justify-start gap-2 text-zinc-600 dark:text-zinc-400 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-mono text-lg">LRN: {{ $student->lrn }}</span>
                </div>
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 px-4 py-2 rounded-full border border-green-200 dark:border-green-800">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-green-700 dark:text-green-300 font-semibold text-sm">Enrolled - Grade {{ $student->grade_level }}</span>
                </div>
            </div>
        </div>

        {{-- School Logo --}}
        <div class="shrink-0">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 p-4 rounded-2xl border border-blue-200 dark:border-blue-800">
                <img src="{{ asset('images/snhs.png') }}" alt="School Logo" class="h-20" />
            </div>
        </div>
    </div>

    {{-- Main Information Grid --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        {{-- Personal Information Card --}}
        <div class="xl:col-span-2 space-y-6">
            {{-- Personal Information --}}
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/10 dark:to-indigo-900/10 p-6 rounded-2xl border border-blue-100 dark:border-blue-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-blue-500 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Personal Information</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Birthdate</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->birthdate }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Birthplace</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->birthplace }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Sex</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->sex }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Age</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($student->birthdate)->age }} years old</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Religion</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->religion }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Mother Tongue</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->mother_tongue }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">IP Status</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->ip ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">4Ps Beneficiary</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->is_4ps ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">PWD Status</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->pwd ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Address Information --}}
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/10 dark:to-pink-900/10 p-6 rounded-2xl border border-purple-100 dark:border-purple-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-purple-500 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Address Information</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Street</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->street }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Barangay</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->barangay }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Municipality</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->municipality }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Province</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->province }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Information --}}
        <div class="space-y-6">
            {{-- Family Information --}}
            <div class="bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/10 dark:to-amber-900/10 p-6 rounded-2xl border border-orange-100 dark:border-orange-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-orange-500 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Family Information</h3>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Father's Name</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->father_name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Mother's Name</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->mother_name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Guardian's Name</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->guardian_name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Contact Number</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->contact_number }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Enrollment Information --}}
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/10 dark:to-emerald-900/10 p-6 rounded-2xl border border-green-100 dark:border-green-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-green-500 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Enrollment Info</h3>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Enrollment Year</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->enrollment_year }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/50 dark:bg-zinc-800/50 rounded-lg">
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Status</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $student->enrollment_status ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-gradient-to-br from-gray-50 to-zinc-50 dark:from-gray-800/50 dark:to-zinc-800/50 p-6 rounded-2xl border border-gray-200 dark:border-zinc-700">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('students.enrolled-list') }}"
                       class="flex items-center gap-3 w-full p-3 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-700 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 group-hover:text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="font-medium text-gray-700 dark:text-gray-300">Back to Enrolled List</span>
                    </a>
                    <button class="flex items-center gap-3 w-full p-3 bg-white dark: