<?php

namespace Modules\User\Observers;

use Modules\User\app\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void {
        $user->assignRole('user');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void {
        $user->syncRoles('user');
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void {
        $user->removeRole('user');
    }
}
