<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser; // <--- Agregar esta línea
use Filament\Panel; // <--- Agregar esta línea
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser // <--- Agregar el "implements"
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', // Asegúrate de que 'role' esté aquí
    ];

    // Esta función decide quién entra al panel
    public function canAccessPanel(Panel $panel): bool
    {
        // Por ahora, permitimos que tanto 'admin' como 'vendedor' entren
        return true; 
    }
    protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed', // <--- Revisa que esta línea exista
];
}