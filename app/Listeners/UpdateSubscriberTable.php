<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use Illuminate\Support\Facades\DB;

class UpdateSubscriberTable
{

    /**
     * Handle the event.
     */
    
    //gets the user
    public function handle(UserSubscribed $event): void
    {
        //use DB facade because we dont have a model
        DB::insert('insert into subscribers (email) values (?)', [$event->user->email]);
    }
}
