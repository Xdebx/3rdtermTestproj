<?php

namespace App\Listeners;

use App\Events\SendCheckupMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Consultation;
use Mail;
use DB;

class SendConsultMail
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
     * @param  \App\Events\SendCheckupMail  $event
     * @return void
     */
    public function handle(SendCheckupMail $event)
    {
        $consults = $event->consults;
        $consults = Consultation::where('consult_id',$event->consults->consult_id)->first();
        Mail::send('email.consultemail', ['observation' => $consults->observation,'pet_id' => $consults->pet_id,'consult_cost' => $consults->consult_cost, 'created_at' => $consults->created_at], function($message) use ($consults) {
            $message->from('adminpetclinic@clinic.com','VetAdmin');
            $message->to(DB::table('customers')->leftJoin('users', 'users.id', '=', 'customers.user_id')->pluck('users.email')->first());
            $message->subject('Thank you');
            $message->attach(public_path('/images/clinicpet.jpg'));
        });
    }
}
