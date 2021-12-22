<?php

namespace App\Observers;

use App\Models\Cities as City;

class CityObserver
{
    /**
     * Handle the Cities "created" event.
     *
     * @param  \App\Models\Cities  $city
     * @return void
     */
    public function creating(City $city)
    {
        $lastId = City::orderBy('id', 'desc')->first();
        $city->setAttribute('id', $lastId->id+1);
    }

}
