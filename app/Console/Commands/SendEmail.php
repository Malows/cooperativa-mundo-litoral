<?php

namespace App\Console\Commands;

use Mail;
use App\Mail\DemoMail;
use App\Message;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the email digest to the target user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $messages = Message::all();

        if ($messages->count() == 0) {
            $this->info("There isn't any message left to send.");
            return null;
        }

        Mail::send(new DemoMail($messages));

        Message::destroy($messages->pluck('id'));
    }
}
