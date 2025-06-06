<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\TaskBot;
use App\Notifications\TaskDueNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class NotifyDueTasks extends Command
{
    protected $signature = 'tasks:notify-due';
    protected $description = 'Notify users of due tasks';

    public function handle()
    {
        $now = Carbon::now();

        // Get all tasks where the deadline is due, not completed, and not reminded
        $tasks = TaskBot::where('deadline', '<=', $now)
            ->where('status', '!=', 'completed')
            ->where('reminder_sent', false)
            ->with('user') // Eager load user to avoid N+1 query issue
            ->get();

        foreach ($tasks as $task) {
            if ($task->user) {
                // Send Email Notification
                $task->user->notify(new TaskDueNotification($task));

                // Send SMS
                $this->sendSms($task->user->phone, "Task Due: {$task->title} at {$task->deadline}");

                // Send WhatsApp Message
                $this->sendWhatsApp($task->user->whatsapp_number, "Task Due: {$task->title}\nDescription: {$task->description}");

                // Mark task as reminded
                $task->reminder_sent = true;
                $task->save();

                $this->info("Notified user {$task->user->name} about task {$task->title}");
            }
        }
    }

    // Send SMS via external service (e.g., Twilio, Termii)
    protected function sendSms($to, $message)
    {
        // Replace this with your SMS service provider API (e.g., Twilio, Termii)
        Http::post('https://api.smsprovider.com/send', [
            'to' => $to,
            'message' => $message,
            'api_key' => 'your_sms_api_key',
        ]);
    }

    // Send WhatsApp message via WhatsApp API (e.g., Twilio API)
    protected function sendWhatsApp($to, $message)
    {
        // Replace with your WhatsApp API provider
        Http::post('https://api.whatsapp.com/send', [
            'to' => $to,
            'message' => $message,
            'token' => 'your_whatsapp_api_token',
        ]);
    }
}
