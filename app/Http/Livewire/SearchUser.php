<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class SearchUser extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search-user', [
            'users' => User::search($this->search),
        ]);
    }
}
