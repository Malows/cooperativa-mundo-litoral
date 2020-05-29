<?php

namespace App\Console\Commands;

use App\Mail\DemoMail;
use App\Mail\TestMail;
use App\Message;
use Illuminate\Console\Command;
use Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email
        {--dry-run : No elimina mensajes}
        {--T|test= : Prueba enviar un correo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the email digest to the target user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('test')) {
            return Mail::to($this->option('test'))->send(new TestMail());
        }

        $messages = Message::all();

        if ($messages->count() === 0) {
            $this->info("There isn't any message left to send.");
            return null;
        }

        Mail::to(env('EMAIL_ADDRESS'))->send(new DemoMail($messages));

        if (! $this->option('dry-run')) {
            Message::destroy($messages->pluck('id'));
        }
    }
}
