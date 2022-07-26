<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\User;
use Mail;

class SendEmailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        // dd($event);
        $user = $event->user;
        $user = User::where('id',$event->user->id)->first();
        Mail::send( 'email.user_notification', ['name' => $user->name, 'email' => $user->email], function($message) use ($user) {
            $message->from('admin@bands.com','Admin');
            // dd($listener);
            $message->to($user->email, $user->name);
            $message->subject('Thank you');
            $message->attach(public_path('/images/logo.jpg'));
        });
    }
}
