<?php

namespace App\Policies;

use App\Models\ApiKey;
use App\Models\User;

class ApiKeyPolicy
{
    /**
     * Determine if user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can view the model.
     */
    public function view(User $user, ApiKey $apiKey): bool
    {
        return $user->id === $apiKey->user_id;
    }

    /**
     * Determine if user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can update the model.
     */
    public function update(User $user, ApiKey $apiKey): bool
    {
        return $user->id === $apiKey->user_id;
    }

    /**
     * Determine if user can delete the model.
     */
    public function delete(User $user, ApiKey $apiKey): bool
    {
        return $user->id === $apiKey->user_id;
    }

    /**
     * Determine if user can restore the model.
     */
    public function restore(User $user, ApiKey $apiKey): bool
    {
        return $user->id === $apiKey->user_id;
    }

    /**
     * Determine if user can permanently delete the model.
     */
    public function forceDelete(User $user, ApiKey $apiKey): bool
    {
        return $user->id === $apiKey->user_id;
    }
}