<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $notifications = Notification::where('scheduled_at', '<=', $now)
            ->where('sent', '=', false)
            ->get();

        foreach($notifications as $notification)
        {
            $user = $notification->user;
            $email = $user->email;

            Mail::raw($notification->content, function ($message) use ($notification, $email) {
                $message->to($email)
                    ->subject($notification->title);

                if($notification->file)
                {
                    $fileDirectory = storage_path('/app/public/notifications/' . $notification->file);

                    $message->attach($fileDirectory, [
                       'as' => $notification->file,
                    ]);
                }

                $notification->update(['sent' => true]);
            });
        }
    }
}
