<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
  public function viewAny(User $user): bool
{
    // Si esto devuelve false, el botón "Users" ni siquiera aparecerá en el menú
    return $user->role === 'admin';
}

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
{
    // Si eres admin, puedes ver el botón de "Agregar"
    return $user->role === 'admin';
}

    
   /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Cambiamos false por esta validación:
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Cambiamos false por esta validación:
        return $user->role === 'admin';
    }
   
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    
    
}
