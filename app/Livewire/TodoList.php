<?php
namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TodoList extends Component
{
    public $newTitle       = '';
    public $newDescription = '';
    public $newPriority    = 'medium';
    public $newDueDate     = null;
    #[Url]
    public $filter = 'all'; // all, today, this_week

    protected $rules = [
        'newTitle'       => 'required|string|min:1|max:255',
        'newDescription' => 'nullable|string|max:1000',
        'newPriority'    => 'required|in:low,medium,high',
        'newDueDate'     => 'nullable|date',
    ];

    public function addTask()
    {
        $this->validate();

        Task::create([
            'title'       => $this->newTitle,
            'description' => $this->newDescription ?? '', // kein NULL speichern
            'priority'    => $this->newPriority,
            'due_date'    => $this->newDueDate,
            'completed'   => false,
            'user_id'     => Auth::id(),
        ]);

        $this->reset(['newTitle', 'newDescription', 'newPriority', 'newDueDate']);
        $this->newPriority = 'medium';
    }

    public function toggleCompleted($id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task->update(['completed' => ! $task->completed]);
    }

    public function deleteTask($id)
    {
        Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail()
            ->delete();
    }

    public function render()
    {
        $query = Task::where('user_id', Auth::id());

        if ($this->filter === 'today') {
            $query->whereDate('due_date', today());
        } elseif ($this->filter === 'this_week') {
            $query->whereBetween('due_date', [now()->startOfWeek(), now()->endOfWeek()]);
        }

        $tasks = $query->orderBy('created_at', 'desc')->get();
        return view('livewire.todo-list', compact('tasks'));
    }
}
