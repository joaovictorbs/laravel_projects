<?php

namespace App\Livewire;

use App\Models\Option;
use Livewire\Attributes\On;
use Livewire\Component;

class Polls extends Component
{
    #[On('pollCreated')]
    public function render()
    {
        $polls = \App\Models\Poll::with('options.votes')
            ->latest()->get();

        return view('livewire.polls', ['polls' => $polls]);
    }
}
