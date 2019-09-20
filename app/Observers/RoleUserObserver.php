<?php

namespace App\Observers;

use App\Model\RoleUser;

class RoleUserObserver
{
    /**
     * Handle the role user "created" event.
     *
     * @param  \App\Model\RoleUser  $roleUser
     * @return void
     */
    public function created(RoleUser $roleUser)
    {
        $roleUser->created_at = date('Y-m-d H:i:s');
        $roleUser->updated_at = date('Y-m-d H:i:s');
    }

    /**
     * Handle the role user "updated" event.
     *
     * @param  \App\Model\RoleUser  $roleUser
     * @return void
     */
    public function updated(RoleUser $roleUser)
    {
        $roleUser->updated_at = date('Y-m-d H:i:s');
    }

    /**
     * Handle the role user "deleted" event.
     *
     * @param  \App\Model\RoleUser  $roleUser
     * @return void
     */
    public function deleted(RoleUser $roleUser)
    {
        //
    }

    /**
     * Handle the role user "restored" event.
     *
     * @param  \App\Model\RoleUser  $roleUser
     * @return void
     */
    public function restored(RoleUser $roleUser)
    {
        //
    }

    /**
     * Handle the role user "force deleted" event.
     *
     * @param  \App\Model\RoleUser  $roleUser
     * @return void
     */
    public function forceDeleted(RoleUser $roleUser)
    {
        //
    }
}
