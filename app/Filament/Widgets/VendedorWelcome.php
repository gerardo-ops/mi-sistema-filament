<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VendedorWelcome extends BaseWidget
{
    // Solo el vendedor podrá ver esto
    public static function canView(): bool
    {
        return auth()->user()->role === 'vendedor';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Estado del Sistema', 'En línea')
                ->description('Panel de vendedor activo')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            
            Stat::make('Tu Perfil', 'Vendedor')
                ->description('Acceso autorizado')
                ->color('info'),
        ];
    }
}