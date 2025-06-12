<?php

namespace OpenSoutheners\FilamentFloatingSearch;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

class FloatingSearchPlugin implements Plugin
{
    public function getId(): string
    {
        return 'floating-search';
    }

    public function register(Panel $panel): void
    {
        // dd($panel->getResources());

        FilamentView::registerRenderHook(PanelsRenderHook::PAGE_END, function () {
            return view('filament-floating-search::modal');
        });
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
