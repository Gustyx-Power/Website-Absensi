<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine apakah user bisa view any users (list semua users)
     * Hanya Owner dan Admin yang bisa
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAdminAccess();
    }

    /**
     * Determine apakah user bisa view detail user tertentu
     * Owner/Admin bisa view semua, Employee hanya bisa view diri sendiri
     */
    public function view(User $user, User $model): bool
    {
        if ($user->hasAdminAccess()) {
            return true;
        }

        return $user->id === $model->id;
    }

    /**
     * Determine apakah user bisa create user baru
     * Hanya Owner yang bisa create user (Admin tidak bisa)
     */
    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine apakah user bisa update user tertentu
     * - Owner bisa update semua
     * - Admin bisa update Employee saja (TIDAK BISA update Owner atau Admin lain)
     * - Employee tidak bisa update siapapun (data sync dari Google)
     */
    public function update(User $user, User $model): bool
    {
        // Owner bisa update siapapun kecuali diri sendiri (untuk keamanan)
        if ($user->isOwner()) {
            return true;
        }

        // Admin hanya bisa update Employee
        if ($user->isAdmin()) {
            return $model->isEmployee();
        }

        // Employee tidak bisa update siapapun
        return false;
    }

    /**
     * Determine apakah user bisa delete user tertentu
     * - Owner bisa delete Admin dan Employee (tidak bisa delete diri sendiri)
     * - Admin TIDAK BISA delete Owner atau Admin lain
     * - Employee tidak bisa delete siapapun
     */
    public function delete(User $user, User $model): bool
    {
        // Tidak bisa delete diri sendiri
        if ($user->id === $model->id) {
            return false;
        }

        // Owner bisa delete Admin dan Employee
        if ($user->isOwner()) {
            return $model->isAdmin() || $model->isEmployee();
        }

        // Admin hanya bisa delete Employee
        if ($user->isAdmin()) {
            return $model->isEmployee();
        }

        // Employee tidak bisa delete siapapun
        return false;
    }

    /**
     * Determine apakah user bisa restore deleted user
     * Hanya Owner
     */
    public function restore(User $user, User $model): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine apakah user bisa force delete user
     * Hanya Owner
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->isOwner();
    }
}
