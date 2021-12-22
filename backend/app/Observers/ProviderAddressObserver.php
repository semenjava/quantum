<?php

namespace App\Observers;

use App\Models\ProviderAddress;

class ProviderAddressObserver
{
    /**
     * Handle the Cities "created" event.
     *
     * @param  ProviderAddress $providerAddress
     * @return void
     */
    public function creating(ProviderAddress $providerAddress)
    {
        $model = ProviderAddress::where('provider_id', $providerAddress->provider_id)->where('address_id', $providerAddress->address_id)->first();
        if($model) {
            $model->delete();
        }
    }

    /**
     * Handle the Cities "updated" event.
     *
     * @param  ProviderAddress $providerAddress
     * @return void
     */
    public function updating(ProviderAddress $providerAddress)
    {
        //
    }
}
