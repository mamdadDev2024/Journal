<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Models\Section;
use Modules\Core\Models\FooterLink;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('footerData', [
                'titleFooter' => Section::where('name', 'titleFooter')->value('content'),
                'aboutUs'     => Section::where('name', 'aboutUs')->value('content'),
                'contactUs'   => Section::where('name', 'contactUs')->value('content'),
                'links'       => FooterLink::all(),
            ]);
        });

    }
}
