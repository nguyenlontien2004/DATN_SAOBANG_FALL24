<?php

namespace App\Policies;

use App\Models\BannerQuangCao;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BannerQuangCaoPolicy
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
    public function view(User $user, BannerQuangCao $bannerQuangCao): bool
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
    public function update(User $user, BannerQuangCao $bannerQuangCao): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BannerQuangCao $bannerQuangCao): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BannerQuangCao $bannerQuangCao): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BannerQuangCao $bannerQuangCao): bool
    {
        //
    }
}
