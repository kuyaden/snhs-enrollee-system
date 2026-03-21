<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 text-[15px] leading-normal font-sans">

    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 text-zinc-800 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 text-[15px] font-normal">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Home')" class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Students')" class="grid">
                <flux:navlist.item icon="user-plus" :href="route('add.students')" :current="request()->routeIs('add.students')" wire:navigate>
                    {{ __('Add Student') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist> --}}
         <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Students')" class="grid">
                <flux:navlist.item icon="clipboard-document-list" :href="route('students.enrolled-list')" :current="request()->routeIs('students.enrolled-list')" wire:navigate>
                    {{ __('Enrolled Students') }}
                </flux:navlist.item>
                <flux:navlist.item :href="route('students.section-manager')" :current="request()->routeIs('students.section-manager')" wire:navigate>
                    <x-slot name="icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </x-slot>
                    {{ __('Sections') }}
                </flux:navlist.item>
                 <flux:navlist.item icon="map" :href="route('students.barangay-map')" :current="request()->routeIs('students.barangay-map')" wire:navigate>
                    {{ __('Barangay Map') }}
                </flux:navlist.item>
                <flux:navlist.item icon="list-bullet" :href="route('students.barangay-list')" :current="request()->routeIs('students.barangay-list')" wire:navigate>
                    {{ __('Barangay List') }}
                </flux:navlist.item>
                <flux:navlist.item icon="folder" :href="route('students.livebirth')" :current="request()->routeIs('students.livebirth')" wire:navigate>
                    {{ __('Live Birth') }}
                </flux:navlist.item>
                <flux:navlist.item icon="folder-open" :href="route('students.form-one-three-students')" :current="request()->routeIs('students.form-one-three-students')" wire:navigate>
                    {{ __('Form 137') }}
                </flux:navlist.item>
                {{-- <flux:navlist.item icon="folder-arrow-down" :href="route('students.school-forms')" :current="request()->routeIs('students.school-forms')" wire:navigate>
                    {{ __('School Forms') }}
                </flux:navlist.item> --}}
            </flux:navlist.group>
        </flux:navlist>


        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Special Categories')" class="grid">
                <flux:navlist.item icon="newspaper" :href="route('students.4Pstudents')" :current="request()->routeIs('students.4Pstudents')" wire:navigate>
                    {{ __('4Ps Beneficiary') }}
                </flux:navlist.item>
                <flux:navlist.item icon="identification" :href="route('students.pwd')" :current="request()->routeIs('students.pwd')" wire:navigate>
                    {{ __('PWD Students') }}
                </flux:navlist.item>
                <flux:navlist.item icon="user-group" :href="route('students.indigenous')" :current="request()->routeIs('students.indigenous')" wire:navigate>
                    {{ __('IP Students') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Tools')" class="grid">
                @if(auth()->user()->can("role.view"))
                <flux:navlist.item icon="users" :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>
                    {{ __('Manage Users') }}
                </flux:navlist.item>
                <flux:navlist.item icon="cog" :href="route('roles.index')" :current="request()->routeIs('roles.index')" wire:navigate>
                    {{ __('Manage Roles') }}
                </flux:navlist.item>
                @endif
            </flux:navlist.group>
        </flux:navlist>
        <flux:navlist variant="outline">
    <flux:navlist.group :heading="__('Archive')" class="grid">
        <flux:navlist.item 
            icon="archive-box" 
            :href="route('students.archived-list')" 
            :current="request()->routeIs('students.archived-list')" 
            wire:navigate>
            {{ __('Archived Students') }}
        </flux:navlist.item>
    </flux:navlist.group>
</flux:navlist>



        @include('partials.theme')

        

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down"
            />

            <flux:menu class="w-[220px] text-[14px] font-normal">
                <flux:menu.radio.group>
                    <div class="p-0">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>


                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>
</html>
