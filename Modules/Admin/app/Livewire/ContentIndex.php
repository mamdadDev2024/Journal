<?php

namespace Modules\Admin\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Activity\Models\Activity;
use Modules\Core\Models\Recommend;
use Modules\Magazine\Models\Magazine;
use Modules\Tip\Models\Tip;

class ContentIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $type = '';
    public $activeTab = 'news'; // Default active tab

    // Tab names for better organization
    protected $tabs = [
        'news' => 'اخبار',
        'events' => 'رویدادها',
        'magazines' => 'نشریه‌ها',
        'recommends' => 'پیشنهادها',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'type' => ['except' => ''],
        'activeTab' => ['except' => 'news'],
    ];

    public function mount()
    {
        // Initial data loading is handled in render method
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage(); // Reset pagination when changing tabs
    }

    public function deleteContent($type, $id)
    {
        try {
            switch ($type) {
                case 'news':
                    $content = Activity::findOrFail($id);
                    break;
                case 'events':
                    $content = Tip::findOrFail($id);
                    break;
                case 'magazines':
                    $content = Magazine::findOrFail($id);
                    break;
                case 'recommends':
                    $content = Recommend::findOrFail($id);
                    break;
                default:
                    throw new \Exception('نوع محتوای نامعتبر');
            }

            $content->delete();

            $this->dispatch('show-toast', [
                'type' => 'success',
                'message' => 'محتوا با موفقیت حذف شد.'
            ]);

        } catch (\Exception $e) {
            $this->dispatch('show-toast', [
                'type' => 'error',
                'message' => 'خطا در حذف محتوا: ' . $e->getMessage()
            ]);
        }
    }

    public function toggleStatus($type, $id)
    {
        try {
            switch ($type) {
                case 'news':
                    $content = Activity::findOrFail($id);
                    break;
                case 'events':
                    $content = Tip::findOrFail($id);
                    break;
                case 'magazines':
                    $content = Magazine::findOrFail($id);
                    break;
                case 'recommends':
                    $content = Recommend::findOrFail($id);
                    break;
                default:
                    throw new \Exception('نوع محتوای نامعتبر');
            }

            // Toggle status - adjust field name according to your models
            $statusField = $content->getTable() === 'activities' ? 'is_active' : 'status';

            if (isset($content->$statusField)) {
                $content->update([
                    $statusField => !$content->$statusField
                ]);
            }

            $this->dispatch('show-toast', [
                'type' => 'success',
                'message' => 'وضعیت محتوا با موفقیت تغییر کرد.'
            ]);

        } catch (\Exception $e) {
            $this->dispatch('show-toast', [
                'type' => 'error',
                'message' => 'خطا در تغییر وضعیت: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        // Load data based on active tab with search and filtering
        $activities = Activity::with('user')
            ->when($this->search && $this->activeTab === 'news', function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'news_page');

        $tips = Tip::with('user')
            ->when($this->search && $this->activeTab === 'events', function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'events_page');

        $magazines = Magazine::with('user')
            ->withCount('articles as articles_count')
            ->when($this->search && $this->activeTab === 'magazines', function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'magazines_page');

        $recommends = Recommend::with('user')
            ->when($this->search && $this->activeTab === 'recommends', function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'recommends_page');

        return view('admin::livewire.content-index', compact('activities', 'tips', 'magazines', 'recommends'));
    }
}

