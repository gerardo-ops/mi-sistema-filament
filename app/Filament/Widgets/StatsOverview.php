<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // SEGURIDAD: Solo el admin puede ver este widget
    public static function canView(): bool
    {
        return auth()->user()->role === 'admin';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Vendedores Activos', User::where('role', 'vendedor')->count())
                ->description('Personal registrado')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            
            Stat::make('Administradores', User::where('role', 'admin')->count())
                ->description('Cuentas con control total')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('danger'),

            Stat::make('Seguridad del Sitio', 'Activa')
                ->description('Roles verificados')
                ->descriptionIcon('heroicon-m-lock-closed')
                ->color('info'),
        ];
    }
}