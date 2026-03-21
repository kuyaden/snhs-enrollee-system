<div class="p-6 space-y-6">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/10 dark:to-amber-900/10 p-6 rounded-2xl border border-orange-100 dark:border-orange-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-orange-500 rounded-xl shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Create Teacher & Staff</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Add new teacher or staff member and assign roles</p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-1 bg-white dark:bg-gray-800 px-3 py-1 rounded-full border border-orange-200 dark:border-orange-800">
                    <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                    <span>New Member</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Back Button --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('users.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Users
        </a>
        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Creating new teacher/staff
        </div>
    </div>

    {{-- Teacher & Staff Creation Form --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Member Information</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Enter details and assign roles for the new member</p>
        </div>
        
        <form class="p-6 space-y-6" wire:submit.prevent="submit">
            {{-- Name Input --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <flux:input 
                        wire:model="name" 
                        name="name" 
                        type="text" 
                        placeholder="Enter full name" 
                        required 
                        class="w-full h-11 pl-10"
                    />
                </div>
                @error('name') 
                    <div class="flex items-center gap-2 text-red-600 dark:text-red-400 text-sm mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Email Input --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <flux:input 
                        wire:model="email" 
                        name="email" 
                        type="email" 
                        placeholder="Enter email address" 
                        required 
                        class="w-full h-11 pl-10"
                    />
                </div>
                @error('email') 
                    <div class="flex items-center gap-2 text-red-600 dark:text-red-400 text-sm mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password Input --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <flux:input 
                        wire:model="password" 
                        name="password" 
                        type="password" 
                        placeholder="Enter password" 
                        required 
                        class="w-full h-11 pl-10"
                    />
                </div>
                @error('password') 
                    <div class="flex items-center gap-2 text-red-600 dark:text-red-400 text-sm mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Confirm Password Input --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <flux:input 
                        wire:model="confirm_password" 
                        name="confirm_password" 
                        type="password" 
                        placeholder="Confirm password" 
                        required 
                        class="w-full h-11 pl-10"
                    />
                </div>
            </div>

            {{-- Roles Section --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Assign Roles</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Select roles for this teacher or staff member
                        </p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
                        {{ count($roles ?? []) }} selected
                    </div>
                </div>

                {{-- Roles Checkbox Group --}}
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                    <flux:checkbox.group 
                        wire:model="roles" 
                        label="Roles"
                        class="space-y-3"
                    >
                        @foreach($allRoles as $role)
                            <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-white dark:hover:bg-gray-800 transition-colors">
                                <flux:checkbox 
                                    label="{{ $role->name }}" 
                                    value="{{ $role->name }}" 
                                    class="text-orange-600 focus:ring-orange-500"
                                />
                            </div>
                        @endforeach
                    </flux:checkbox.group>
                </div>
                @error('roles') 
                    <div class="flex items-center gap-2 text-red-600 dark:text-red-400 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="button" 
                        onclick="window.history.back()" 
                        class="px-6 py-3 text-sm font-medium text-gray-700 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm">
                    Cancel
                </button>
                
                <flux:button 
                    variant="primary" 
                    type="submit" 
                    class="inline-flex items-center gap-3 px-8 py-3 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 transition-all duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
                    Create Teacher/Staff
                </flux:button>
            </div>
        </form>
    </div>
</div>