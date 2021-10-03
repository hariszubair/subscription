<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\MailBox;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user_name = $this->details['user_name'];
        $user_id = $this->details['user_id'];
        $post_id = $this->details['post_id'];
        $title = $this->details['title'];
        $description = $this->details['description'];
        $email = $this->details['email'];
        $website = $this->details['website'];
        $count = MailBox::where('user_id', $user_id)->where('post_id', $post_id)->count();
        if ($count == 0) {
            Mail::to($email)->send(new SendMail($title, $description, $user_name, $website));
            MailBox::create([
                'user_id' => $user_id,
                'post_id' => $post_id
            ]);
        }
    }
}
