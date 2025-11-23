<?php

namespace Modules\Auth\Services;

use Modules\Auth\Actions\ForgotPasswordAction;
use Modules\Core\app\Contracts\BaseService;
use Modules\Auth\Actions\LoginAction;
use Modules\Auth\Actions\RegisterAction;
use Modules\Auth\Actions\ResetPasswordAction;
use Modules\Auth\Actions\LogoutAction;

class AuthService extends BaseService
{
    public function __construct(
        private LoginAction $loginAction,
        private RegisterAction $registerAction,
        private ResetPasswordAction $resetPasswordAction,
        private ForgotPasswordAction $forgotPasswordAction,
        private LogoutAction $logoutAction,
    ) {}

    public function resetPassword(array $data)
    {
        return $this->execute(function () use ($data) {
            return $this->resetPasswordAction->handle($data);
        });
    }

    public function forgotPassword(array $data)
    {
        return $this->execute(function () use ($data) {
            return $this->forgotPasswordAction->handle($data);
        });
    }
    public function register(array $data)
    {
        return $this->execute(function () use ($data) {
            return $this->registerAction->handle($data);
        });
    }
    public function login(array $data)
    {
        return $this->execute(function () use ($data) {
            return $this->loginAction->handle($data);
        });
    }

    public function logout()
    {
        return $this->execute(function () {
            return $this->logoutAction->handle();
        });
    }
}
