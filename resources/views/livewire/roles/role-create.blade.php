<div class="p-6 space-y-6">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/10 dark:to-indigo-900/10 p-6 rounded-2xl border border-purple-100 dark:border-purple-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-purple-500 rounded-xl shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Create New Role</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Create a new role and assign permissions</p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-1 bg-white dark:bg-gray-800 px-3 py-1 rounded-full border border-purple-200 dark:border-purple-800">
                    <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
                    <span>New Role</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Back Button --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('roles.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Roles
        </a>
        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Creating new role
        </div>
    </div>

    {{-- Role Creation Form --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Role Details</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Define the role name and assign permissions</p>
        </div>
        
        <form class="p-6 space-y-6" wire:submit.prevent="submit">
            {{-- Role Name Input --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role Name</label>
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
                        placeholder="Enter role name (e.g., Manager, Editor)" 
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

            {{-- Permissions Section --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Role Permissions</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Select the permissions to assign to this role
                        </p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
                        {{ count($permissions ?? []) }} selected
                    </div>
                </div>

                {{-- Permissions Checkbox Group --}}
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                    <flux:checkbox.group 
                        wire:model="permissions" 
                        label="Admin and User Permissions"
                        class="space-y-3"
                    >
                        @foreach ($allPermissions as $permission)
                            <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-white dark:hover:bg-gray-800 transition-colors">
                                <flux:checkbox 
                                    label="{{ $permission->name }}" 
                                    value="{{ $permission->name }}" 
                                    checked 
                                    class="text-purple-600 focus:ring-purple-500"
                                />
                            </div>
                        @endforeach
                    </flux:checkbox.group>
                </div>
                
                @error('permissions') 
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

                    Create Role
                </flux:button>
            </div>
        </form>
    </div>
</div>