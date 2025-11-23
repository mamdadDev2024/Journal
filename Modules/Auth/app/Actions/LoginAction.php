<?php

namespace Modules\Auth\Actions;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Core\app\Contracts\BaseService;
use Illuminate\Support\Facades\Auth;
use Modules\User\Models\User;

class LoginAction
{
    public function handle(array $data)
    {
        $user = User::whereEmail($data['email'])->first();
        if (!$user->exists()) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed')
            ]);
        }
        if(!Hash::check($data['password'] , $user->first()->getAuthPassword())){
            throw ValidationException::withMessages([
                'password' => __('auth.failed')
            ]);
        }

        Auth::attempt($data , true);
        return true;
    }
}
