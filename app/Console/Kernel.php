<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Notifications\TaskDueNotification;
use App\Models\Task;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Run the task notification every minute
        $schedule->call(function () {
            $tasks = Task::where('deadline', '<=', now())
                ->where('status', 'pending')
                ->get();

            foreach ($tasks as $task) {
                // Send the notification to the user
                if ($task->user) {
                    $task->user->notify(new TaskDueNotification($task));
                }

                // Optionally, mark the task as "in progress" or "completed" after notification
                $task->status = 'in_progress'; // Or 'completed'
                $task->save();
            }
        })->everyMinute();  // Runs every minute
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
