<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User; // Pastikan model User sudah ada

class Users extends Component
{
    public function render()
    {
        $users = User::all(); // Mengambil semua data user dari database
        return view('livewire.users', ['users' => $users]);
    }
}