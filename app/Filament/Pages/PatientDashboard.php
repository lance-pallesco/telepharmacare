<?php

namespace Filament\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;

class PatientDashboard extends Page
{
    protected static string $routePath = '/patient';
    protected static ?string $title = 'Dashboard';

    public static function canAccess(): bool
    {
        return Auth::user()->role === 'patient';
    }

    public static function getRoutePath(Panel $panel): string
    {
        return static::$routePath;
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-home';
    }
    
    public function getColumns(): int | array
    {
        return 2;
    }

    public function getWidgets(): array
    {
        return Filament::getWidgets();
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                ...(method_exists($this, 'getFiltersForm') ? [$this->getFiltersFormContentComponent()] : []),
                $this->getWidgetsContentComponent(),
            ]);
    }

    public function getFiltersFormContentComponent(): Component
    {
        return EmbeddedSchema::make('filtersForm');
    }

    public function getWidgetsContentComponent(): Component
    {
        return Grid::make($this->getColumns())
            ->schema($this->getWidgetsSchemaComponents($this->getWidgets()));
    }
}
