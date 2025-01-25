<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDueNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckDueTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:check-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for tasks due in 24 hours and send notifications';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::query()
            ->whereNotNull('due_date')
            ->where('due_date', '>', Carbon::now())
            ->where('due_date', '<=', Carbon::now()->addHours(24))
            ->where('progress', '!=', 'done')
            ->with(['user', 'project'])
            ->get();

        foreach ($tasks as $task) {
            $existingNotification = $task->user->notifications()
            ->where('type', TaskDueNotification::class)
            ->whereJsonContains('data->task_id', $task->id)
            ->exists();

            if (!$existingNotification) {
                $task->user->notify(new TaskDueNotification($task));
            }
        }

        $this->info("Sent notifications for {$tasks->count()} tasks.");

        return Command::SUCCESS;
    }
}
