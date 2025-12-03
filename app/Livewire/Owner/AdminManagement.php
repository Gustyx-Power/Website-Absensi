<?php

namespace App\Livewire\Owner;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;
    public $showDeleteModal = false;
    public $selectedUserId = null;
    public $userEmail = '';

    protected $rules = [
        'userEmail' => 'required|email|exists:users,email',
    ];

    /**
     * Reset pagination saat search berubah
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Promote user ke Admin
     */
    public function promoteToAdmin()
    {
        $this->validate();

        $user = User::where('email', $this->userEmail)->first();

        // Validasi: tidak bisa promote Owner
        if ($user->isOwner()) {
            session()->flash('error', 'Tidak dapat mengubah role Owner!');
            return;
        }

        // Validasi: sudah Admin
        if ($user->isAdmin()) {
            session()->flash('error', 'User sudah memiliki role Admin!');
            $this->closeModal();
            return;
        }

        // Promote ke admin
        $user->update(['role' => 'admin']);

        session()->flash('success', "Berhasil promote {$user->name} menjadi Admin!");
        $this->closeModal();
    }

    /**
     * Demote admin kembali ke employee
     */
    public function demoteAdmin($userId)
    {
        $user = User::findOrFail($userId);

        // Validasi: tidak bisa demote Owner
        if ($user->isOwner()) {
            session()->flash('error', 'Tidak dapat mengubah role Owner!');
            return;
        }

        // Validasi: harus Admin
        if (!$user->isAdmin()) {
            session()->flash('error', 'User bukan Admin!');
            return;
        }

        // Demote ke employee
        $user->update(['role' => 'employee']);

        session()->flash('success', "{$user->name} telah di-demote kembali ke Employee.");
    }

    /**
     * Show create modal
     */
    public function openCreateModal()
    {
        $this->reset(['userEmail']);
        $this->showCreateModal = true;
    }

    /**
     * Close modal
     */
    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->reset(['userEmail']);
    }

    /**
     * Render component
     */
    public function render()
    {
        // Query admins (tidak termasuk Owner)
        $admins = User::where('role', 'admin')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        // Get owner info
        $owner = User::where('role', 'owner')->first();

        return view('livewire.owner.admin-management', [
            'admins' => $admins,
            'owner' => $owner,
        ]);
    }
}
