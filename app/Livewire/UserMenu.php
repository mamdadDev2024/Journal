<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserMenu extends Component
{
    public bool $open = false;
    public $user;
    public $roles = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->roles = $this->user?->getRoleNames()->toArray() ?? [];
    }

    public function toggleMenu()
    {
        $this->open = !$this->open;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('components.livewire.user-menu');
    }
}
