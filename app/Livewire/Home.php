<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Activity\Models\Activity;
use Modules\Magazine\Models\Magazine;
use Modules\Core\Models\Section;
use Modules\Tip\Models\Tip;

class Home extends Component
{
    public $activities;
    public $tips;
    public $magazines;
    public $sections;

    public function render()
    {
        $this->activities = Activity::latest()->take(10)->get();
        $this->tips       = Tip::latest()->take(10)->get();
        $this->magazines  = Magazine::latest()->take(10)->get();
        $this->sections = Section::whereIn('name', ['magazineGuide'])->pluck('content', 'name')->toArray();

        return view('livewire.home');
    }
}
