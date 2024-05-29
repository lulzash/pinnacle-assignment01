<?php

namespace App\Console\Commands;

use Mail;
use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\EmailNotification;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = [
            ['name' => 'Akshay Dhalwar', 'email' => 'akshay.dhalwar@gmail.com'],
            ['name' => 'Ashransomer', 'email' => 'ashransomer@gmail.com.com'],
        ];
    
        foreach ($users as $user) {
            $notifiable = new User();
            $notifiable->email = $user['email'];
            $notifiable->notify(new EmailNotification($user));
        }
    
        $this->info('Email notifications have been queued to send!');

        $this->info('Emails have been sent successfully!');
    }
}
