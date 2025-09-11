<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TodoList extends Component
{
    public $newTitle = '';
    public $newDescription = '';
    public $newPriority = 'medium';
    public $newDueDate = null;

    protected $rules = [
        'newTitle' => 'required|string|min:1|max:255',
        'newDescription' => 'nullable|string|max:1000',
        'newPriority' => 'required|in:low,medium,high',
        'newDueDate' => 'nullable|date',
    ];
    public function addTask() {
        $this->validate();

        Task::create([
            'title' => $this->newTitle,
            'description' => $this->newDescription,
            'priority' => $this->newPriority,
            'due_date' => $this->newDueDate,
            'completed' => false,
        ]);

        $this->reset(['newTitle', 'newDescription', 'newPriority', 'newDueDate']);
        $this->newPriority = 'medium'; // Default Einstellung
    }

    public function toggleCompleted($id) {
        $task = Task::findOrFail($id);
        $task->update(['completed' => ! $task->completed]);
    }

    public function deleteTask($id) {
        $task = Task::findOrFail($id)->delete();
    }
    public function render()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('livewire.todo-list', compact('tasks'));
    }
}
