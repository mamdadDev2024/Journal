<?php

namespace Modules\Magazine\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Magazine\Models\Magazine;
use Modules\Core\Models\Category;
use Modules\Magazine\Services\MagazineService;

class MagazineCreate extends Component
{
    use WithFileUploads;

    public $title = '';
    public $desc = '';
    public $image;
    public $addOn;
    public $categories = [];
    public $articles = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'desc' => 'required|string',
        'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'addOn' => 'required|file|mimes:pdf,docx|max:10240',
        'categories' => 'required|array|min:1',
        'categories.*' => 'exists:categories,id',
        'articles' => 'required|array|min:1',
        'articles.*.title' => 'required|string|max:255',
        'articles.*.author' => 'required|string|max:255',
        'articles.*.addOn' => 'required|file|mimes:pdf,docx|max:10240',
        'articles.*.abstract' => 'required|string|min:50',
        'articles.*.body' => 'required|string|min:100',
    ];

    protected MagazineService $service;

    public function boot(MagazineService $service)
    {
        $this->service = $service;
    }
    public function mount()
    {
        $this->articles = [
            ['title' => '', 'author' => '', 'addOn' => null, 'abstract' => '', 'body' => '']
        ];
    }

    public function addArticle()
    {
        $this->articles[] = ['title' => '', 'author' => '', 'addOn' => null, 'abstract' => '', 'body' => ''];
    }

    public function removeArticle($index)
    {
        if (count($this->articles) > 1) {
            unset($this->articles[$index]);
            $this->articles = array_values($this->articles);
        }
    }

    public function save()
    {
        $this->validate();

        // ذخیره نشریه و مقالات
        // این بخش را با منطق ذخیره‌سازی خود پر کنید

        session()->flash('message', 'نشریه با موفقیت ایجاد شد.');
        return redirect()->route('writer.magazine.index');
    }

    public function render()
    {
        $categoryOptions = Category::all()->pluck('name', 'id')->toArray();

        return view('magazine::livewire.magazine-create', [
            'categoryOptions' => $categoryOptions,
            'rules' => $this->rules
        ]);
    }
}
