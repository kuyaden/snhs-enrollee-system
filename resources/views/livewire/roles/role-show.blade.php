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
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Role Details</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">View role information and assigned permissions</p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-1 bg-white dark:bg-gray-800 px-3 py-1 rounded-full border border-purple-200 dark:border-purple-800">
                    <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                    <span>Viewing Role</span>
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
            Viewing role details
        </div>
    </div>

    {{-- Role Details Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Role Information</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Details and permissions for this role</p>
        </div>
        
        <div class="p-6 space-y-6">
            {{-- Role Name --}}
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Role Name</h4>
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $role->name }}</p>
                    </div>
                </div>
            </div>

            {{-- Permissions Section --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Assigned Permissions</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            Permissions granted to this role
                        </p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
                        {{ $role->permissions ? $role->permissions->count() : 0 }} permissions
                    </div>
                </div>

                {{-- Permissions Grid --}}
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                    @if ($role->permissions && $role->permissions->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($role->permissions as $permission)
                                @php
                                    $badgeClass = match($permission->name) {
                                        'role.edit' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800',
                                        'role.delete' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 border border-red-200 dark:border-red-800',
                                        'role.create' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 border border-green-200 dark:border-green-800',
                                        'role.view', 'role.show' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300 border border-yellow-200 dark:border-yellow-800',
                                        'role.index' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800',
                                        default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600',
                                    };
                                    
                                    $permissionIcons = match($permission->name) {
                                        'role.edit' => 'text-blue-600 dark:text-blue-400',
                                        'role.delete' => 'text-red-600 dark:text-red-400',
                                        'role.create' => 'text-green-600 dark:text-green-400',
                                        'role.view', 'role.show' => 'text-yellow-600 dark:text-yellow-400',
                                        'role.index' => 'text-emerald-600 dark:text-emerald-400',
                                        default => 'text-gray-600 dark:text-gray-400',
                                    };
                                @endphp
                                
                                <div class="flex items-center gap-3 p-4 rounded-lg {{ $badgeClass }} shadow-sm">
                                    <svg class="w-5 h-5 {{ $permissionIcons }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-sm font-medium">{{ $permission->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">No permissions assigned to this role</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('roles.index') }}" 
                   class="px-6 py-3 text-sm font-medium text-gray-700 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm">
                    Back to List
                </a>
                
                @can('role.edit')
                <a href="{{ route('roles.edit', $role->id) }}" 
                   class="inline-flex items-center gap-3 px-8 py-3 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Role
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>