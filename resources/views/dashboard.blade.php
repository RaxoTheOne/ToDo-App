<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Welcome-Seite Stil übernehmen -->
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg" />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                <!-- Dashboard Content -->
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                {{ __("You're logged in!") }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ToDo-List -->
                <div
                    class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-lg shadow-gray-500/20 dark:bg-zinc-900 dark:shadow-none dark:ring-1 dark:ring-inset dark:ring-white/5">
                    <div class="pt-3 sm:pt-5 w-full">
                        <h2 class="text-xl font-semibold text-black dark:text-white mb-4">Meine ToDo-Liste</h2>
                        <livewire:todo-list />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
