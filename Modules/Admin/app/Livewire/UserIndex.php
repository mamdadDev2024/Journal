<?php

namespace Modules\Admin\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class UserIndex extends Component
{
    use WithPagination;

    public $roles;
    public $selectedRoles = [];

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'selectedRoles.*' => 'string|exists:roles,name',
    ];

    public function mount()
    {
        $this->roles = Role::where('name', '!=', 'super admin')->get(['name', 'id']);
        $users = User::where('username', '!=', 'admin')->get();
        foreach ($users as $user) {
            $this->selectedRoles[$user->id] = $user->roles()->pluck('name')->first();
        }
    }

    public function updateUsers()
    {
        $validated = $this->validate();

        try {
            foreach ($validated['selectedRoles'] as $userId => $roleName) {
                $user = User::find($userId);
                if ($user && $roleName) {
                    $user->syncRoles([$roleName]);
                }
            }

            $this->dispatch('toastMagic',
                status: 'success',
                title: 'تغییرات اعمال شد',
                message: 'وضعیت و نقش کاربران با موفقیت به‌روزرسانی شد.'
            );
        } catch (\Exception $e) {
            Log::error('Error updating users: '.$e->getMessage());

            $this->dispatch('toastMagic',
                status: 'error',
                title: 'خطا!',
                message: 'عملیات انجام نشد. لطفا دوباره تلاش کنید.'
            );
        }
    }
    public function changeRole($userId, $roleName)
    {
        try {
            $user = User::findOrFail($userId);
            $user->syncRoles([$roleName]);
            $this->selectedRoles[$userId] = $roleName;

            $this->dispatch('toastMagic',
                status: 'info',
                title: 'نقش کاربر تغییر کرد',
                message: "نقش کاربر {$user->username} با موفقیت به {$roleName} تغییر یافت."
            );
        } catch (\Exception $e) {
            Log::error('Error changing user role: '.$e->getMessage());

            $this->dispatch('toastMagic',
                status: 'error',
                title: 'خطا',
                message: 'در فرآیند تغییر نقش مشکلی رخ داد!'
            );
        }
    }

    public function render()
    {
        $users = User::where('username', '!=', 'admin')->paginate(10);

        return view( 'admin::livewire.user-index', [
            'users' => $users,
        ]);
    }
}
