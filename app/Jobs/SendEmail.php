<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $nom;
    protected $code;
    protected $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($nom,$code,$email)
    {
        $this->nom = $nom;
        $this->code = $code;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       Mail::send('sendEmail', ['nom' => $nom, 'code' => $code], function ($message) use ($email)
        {
            $message->from('dsi.energiebf@gmail.com', 'DSI ME');
            
            $message->to($email)->subject('Formation 5000 jeunes');;
 
        });
    }
}
