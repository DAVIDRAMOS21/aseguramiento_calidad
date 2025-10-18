<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class TestPage extends Component
{
    public function render()
    {
        $user = Auth::user();

        return view('livewire.test-page', [
            'user' => $user,
            'isAuthenticated' => Auth::check(),
            'userId' => Auth::id(),
            'sessionId' => session()->getId(),
        ]);
    }
}