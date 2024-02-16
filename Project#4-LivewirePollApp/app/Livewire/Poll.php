<?php

namespace App\Livewire;

use App\Models\Poll as ModelsPoll;
use Livewire\Component;

class Poll extends Component
{
    public $title;
    public $options = [''];

    protected $rules = [
        'title' => 'required|min:6|max:255',
        'options' => 'required|array|min:1|max:10',
        'options.*' => 'required|min:1|max:255'
    ];
    protected $messages = [
        'options.*' => "The option can't be empty", 
    ];

    public function render()
    {
        return view('livewire.poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index) {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function createPoll() {
        $this->validate();
        $poll = \App\Models\Poll::create([
            'title' => $this->title
        ]);

        foreach($this->options as $optionName) {
            $poll->options()->create([
                'name' => $optionName
            ]);
        }
        $this->reset(['title' , 'options']);
        $this->emit('pollCreated');
    }
 

  
}
