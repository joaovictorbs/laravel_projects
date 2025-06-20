<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreatePoll extends Component
{
    #[Validate('required|min:3')]
    public $title;
    
    #[Validate([
        'options' => 'required|array|min:1|max:10',
        'options.*' => 'required|min:1|max:255'
    ])]
    public $options = ['First'];
    

    protected $messages = [
        'options.*' => 'The option can\'t be empty.'
    ];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createPoll()
    {
        $this->validate();

        Poll::create([
            'title' => $this->title
        ])->options()->createMany(
            collect($this->options)
                ->map(fn($option) => ['name' => $option])
                ->all()
        );

        $this->reset(['title', 'options']);

        $this->dispatch('pollCreated');
    }
}
