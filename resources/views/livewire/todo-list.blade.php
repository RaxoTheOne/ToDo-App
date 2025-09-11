<div class="w-full">
    <!-- Eingabeformular -->
    <form wire:submit.prevent="addTask" class="space-y-3">
        <input
            type="text"
            wire:model.defer="newTitle"
            placeholder="Titel der Aufgabe"
            class="w-full rounded border px-3 py-2 focus:outline-none focus:ring"
        />

        <textarea
            wire:model.defer="newDescription"
            placeholder="Beschreibung (optional)"
            class="w-full rounded border px-3 py-2 focus:outline-none focus:ring"
        ></textarea>

        <div class="flex gap-3">
            <!-- Priorität -->
            <select wire:model.defer="newPriority" class="rounded border px-3 py-2">
                <option value="low">Niedrig</option>
                <option value="medium">Mittel</option>
                <option value="high">Hoch</option>
            </select>

            <!-- Fälligkeitsdatum -->
            <input
                type="date"
                wire:model.defer="newDueDate"
                class="rounded border px-3 py-2"
            />
        </div>

        <button type="submit" class="rounded bg-[#FF2D20] px-4 py-2 text-white hover:bg-[#e62a1c]">
            Hinzufügen
        </button>
    </form>

    <!-- Fehleranzeige -->
    @error('newTitle') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

    <!-- Liste -->
    <ul class="mt-6 space-y-2">
        @forelse($tasks as $task)
            <li class="rounded border p-3 flex justify-between items-center bg-white">
                <div class="flex flex-col">
                    <span class="{{ $task->completed ? 'line-through text-gray-400' : '' }}">
                        <strong>{{ $task->title }}</strong>
                    </span>
                    @if($task->description)
                        <span class="text-sm text-gray-600">{{ $task->description }}</span>
                    @endif
                    <span class="text-xs text-gray-500">
                        Priorität: {{ ucfirst($task->priority) }}
                        @if($task->due_date)
                            | Fällig: {{ $task->due_date->format('d.m.Y') }}
                        @endif
                    </span>
                </div>

                <div class="flex gap-2">
                    <input
                        type="checkbox"
                        wire:click="toggleCompleted({{ $task->id }})"
                        {{ $task->completed ? 'checked' : '' }}
                    />
                    <button wire:click="deleteTask({{ $task->id }})" class="text-red-500 hover:underline">
                        Löschen
                    </button>
                </div>
            </li>
        @empty
            <li class="text-gray-500">Keine Aufgaben vorhanden.</li>
        @endforelse
    </ul>
</div>

