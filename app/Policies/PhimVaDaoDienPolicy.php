<?php

namespace App\Policies;

use App\Models\PhimVaDaoDien;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PhimVaDaoDienPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PhimVaDaoDien $phimVaDaoDien): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PhimVaDaoDien $phimVaDaoDien): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PhimVaDaoDien $phimVaDaoDien): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PhimVaDaoDien $phimVaDaoDien): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PhimVaDaoDien $phimVaDaoDien): bool
    {
        //
    }
}
