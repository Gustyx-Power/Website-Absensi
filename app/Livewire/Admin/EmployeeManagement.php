<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDepartment = '';
    public $showEditModal = false;
    public $editingUser;
    public $editEmail;
    public $editDepartment;

    /**
     * Reset pagination saat search berubah
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Show edit modal untuk employee
     */
    public function edit($userId)
    {
        $this->editingUser = User::findOrFail($userId);

        // Authorization check: Admin tidak bisa edit Owner
        if (!auth()->user()->isOwner() && $this->editingUser->isOwner()) {
            session()->flash('error', 'Anda tidak memiliki akses untuk mengedit Owner.');
            return;
        }

        $this->editEmail = $this->editingUser->email;
        $this->editDepartment = $this->editingUser->department;
        $this->showEditModal = true;
    }

    /**
     * Update employee data
     */
    public function updateEmployee()
    {
        $this->validate([
            'editEmail' => 'required|email|unique:users,email,' . $this->editingUser->id,
            'editDepartment' => 'nullable|string|max:100',
        ], [
            'editEmail.required' => 'Email wajib diisi.',
            'editEmail.email' => 'Format email tidak valid.',
            'editEmail.unique' => 'Email sudah digunakan.',
        ]);

        // Authorization check lagi
        if (!auth()->user()->can('update', $this->editingUser)) {
            session()->flash('error', 'Anda tidak memiliki akses untuk mengedit user ini.');
            return;
        }

        $this->editingUser->update([
            'email' => $this->editEmail,
            'department' => $this->editDepartment,
        ]);

        session()->flash('success', 'Data employee berhasil diupdate!');
        $this->showEditModal = false;
        $this->reset(['editingUser', 'editEmail', 'editDepartment']);
    }

    /**
     * Close modal
     */
    public function closeModal()
    {
        $this->showEditModal = false;
        $this->reset(['editingUser', 'editEmail', 'editDepartment']);
    }

    /**
     * Render component
     */
    public function render()
    {
        $query = User::where('role', 'employee')
            ->orderBy('name');

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Filter by department
        if ($this->filterDepartment) {
            $query->where('department', $this->filterDepartment);
        }

        $employees = $query->paginate(15);

        // Get unique departments untuk filter
        $departments = User::where('role', 'employee')
            ->distinct()
            ->pluck('department')
            ->filter()
            ->sort();

        return view('livewire.admin.employee-management', [
            'employees' => $employees,
            'departments' => $departments,
        ])->layout('layouts.app');
    }
}
