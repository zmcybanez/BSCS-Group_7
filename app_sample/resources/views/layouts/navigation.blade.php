<nav x-data="{ open: false, darkMode: false }" class="fixed inset-y-0 left-0 w-64 bg-green-600 dark:bg-green-900 shadow-lg flex flex-col z-50 transition-all duration-300 ease-in-out">
    <div class="flex items-center h-16 px-4">
        <a href="{{ route('dashboard') }}" class="text-white font-bold text-xl flex items-center gap-2">
            <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="w-10 h-10 object-contain">
            Farm Guide
        </a>
    </div>

    <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
        <a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="block px-3 py-2 rounded-md text-white dark:text-green-200 hover:bg-green-700 dark:hover:bg-green-800 transition-colors duration-200 font-medium {{ request()->routeIs('dashboard') ? 'bg-green-800 dark:bg-green-700' : '' }}">
            Dashboard
        </a>
        <!-- Add more nav links here as needed -->
    </nav>

    <div class="px-4 py-4 border-t border-green-700 dark:border-green-800 flex items-center justify-between">
        <button @click="darkMode = !darkMode; $el.closest('html').classList.toggle('dark')" class="p-2 rounded-md text-white dark:text-green-200 hover:bg-green-700 dark:hover:bg-green-800 transition-colors duration-200">
            <svg x-show="!darkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg x-show="darkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        </button>

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white dark:text-green-200 hover:text-green-300 dark:hover:text-green-400 focus:outline-none transition ease-in-out duration-150 bg-green-600 dark:bg-green-900 border-green-700 dark:border-green-800">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')" class="text-white dark:text-green-200 hover:bg-green-700 dark:hover:bg-green-800">
                    Profile
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-white dark:text-green-200 hover:bg-green-700 dark:hover:bg-green-800">
                        Log Out
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
