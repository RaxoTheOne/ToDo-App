<x-app-layout>
    <div class="min-h-screen bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 relative">
        <!-- Background Image -->
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg" />
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-white/80 backdrop-blur-sm shadow-lg z-10">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-8">Meine Aufgaben</h1>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Alle Aufgaben
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Heute
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Diese Woche
                    </a>
                </nav>

                <!-- Projekte -->
                <div class="mt-8">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Projekte</h3>
                    <div class="space-y-1">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                            Arbeit
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                            Persönlich
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            Einkaufen
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 relative z-10">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-sm shadow-sm border-b">
                <div class="px-6 py-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Alle Aufgaben</h2>
                    <p class="text-sm text-gray-500 mt-1">Verwalte deine Aufgaben effizient</p>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6">
                <livewire:todo-list />
            </main>
        </div>
    </div>
</x-app-layout>
