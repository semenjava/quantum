<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\UserRoleTrait;

class UserObserver
{
    use UserRoleTrait;

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->addPermissions($user);
    }

}
