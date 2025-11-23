<?php

namespace Modules\Magazine\Livewire;

use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Modules\Magazine\Models\Magazine;

class MagazineShow extends Component
{
    public function render(Magazine $Magazine)
    {
                try {
            $magazine = $Magazine::laodCount(['comments', 'views'])
                ->laodCount(['likers as like_count'])
                ->laod([
                    'user',
                    'articles',
                    'comments' => fn ($q) => $q->where('status', 1),
                ])
                ->first();

            if (! $magazine) {
                ToastMagic::error('موجود نیست!', 'شاید آدرسو اشتباه رفتی!');

                return redirect()->back();
            }

            if (Auth::check()) {
                $magazine->views()->firstOrCreate([
                    'ip_address' => request()->ip(),
                    'user_id' => Auth::id(),
                ]);
            }

            $categoryIds = $magazine->categories()->pluck('id');
            $relateds = $categoryIds->isNotEmpty()
                ? Magazine::whereHas('categories', fn ($q) => $q->whereIn('id', $categoryIds))
                    ->where('id', '!=', $magazine->id)
                    ->with('user')->limit(10)->get()
                : Magazine::with('user')->limit(10)->get();

            $categories = $magazine->categories()->get();

            return view('magazine::livewire.magazine-show', compact('magazine', 'relateds', 'type', 'categories'));

        } catch (\Throwable $th) {
            Log::error("Error in show logic for magazine", [
                'slug' => $magazine->title,
                'user_id' => Auth::id(),
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            ToastMagic::error('موجود نیست!', 'شاید آدرسو اشتباه رفتی!');

            return redirect('/');
        }
    }

}
