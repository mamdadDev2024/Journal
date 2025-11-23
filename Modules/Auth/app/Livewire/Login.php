<?php

namespace Modules\Auth\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Modules\Auth\Services\AuthService;

class Login extends Component
{
    #[Validate('required|email|exists:users,email')]
    public string $email = '';

    #[Validate('required|string|min:8|max:255')]
    public string $password = '';

    protected AuthService $service;

    public function boot(AuthService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('auth::livewire.login');
    }

    public function login()
    {
        $result = $this->service->login($this->validate());
        if ($result->status) {
            $this->dispatch('toastMagic',
                status: 'success',
                title: 'ورود موفق',
                message: 'کاربر با موفقیت وارد شد.'
            );

            return redirect()->intended(route('user.profile'));
        }

        $this->addError('email', $result->message);
        $this->dispatch('toastMagic',
            status: 'error',
            title: 'خطا',
            message: $result->message
        );
    }
}
