<?php

namespace Modules\Core\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Activity\Models\Activity;
use Modules\Magazine\Models\Article;
use Modules\Magazine\Models\Magazine;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Modules\Tip\Models\Tip;

class Search extends Component
{
    use WithPagination;

    public string $search = '';
    public string $type = 'all';

    public int $page = 1;

    protected array $modelMap = [
        'Magazine' => Magazine::class,
        'Tip'    => Tip::class,
        'Activity'   => Activity::class,
        'Article'  => Article::class,
    ];

    // query string mapping
    protected $queryString = [
        'search' => ['except' => ''],
        'type'   => ['except' => 'all'],
        'page'   => ['except' => 1],
    ];

    public function updated($field)
    {
        if (in_array($field, ['search', 'type'])) {
            $this->resetPage();    // Livewire auto resets $page
        }
    }

    public function getResultsProperty()
    {
        $perPage = 10;
        $page = $this->page;
        $search = trim($this->search);

        try {

            // حالت all → merge همه مدل‌ها
            if ($this->type === 'all') {

                $merged = collect($this->modelMap)
                    ->flatMap(fn($model) =>
                    $model::query()
                        ->when($search !== '', fn($q) =>
                        $q->where('title', 'like', "%{$search}%")
                        )
                        ->get()
                    )
                    ->sortByDesc('created_at')
                    ->values();

                return new LengthAwarePaginator(
                    $merged->forPage($page, $perPage),
                    $merged->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            }

            // حالت یک مدل خاص
            if (array_key_exists($this->type, $this->modelMap)) {

                $model = $this->modelMap[$this->type];

                return $model::query()
                    ->when($search !== '', fn($q) =>
                    $q->where('title', 'like', "%{$search}%")
                    )
                    ->latest()
                    ->paginate(
                        $perPage,
                        ['*'],
                        'page',      // مهم! تا Livewire اشتباه نکنه
                        $this->page
                    );
            }

        } catch (\Exception $e) {
            Log::error('Search failed', [
                'msg' => $e->getMessage(),
            ]);

            return Magazine::latest()->paginate($perPage);
        }

        return Magazine::latest()->paginate($perPage);
    }

    public function render()
    {
        return view('core::livewire.search', [
            'results' => $this->results,
        ]);
    }
}
