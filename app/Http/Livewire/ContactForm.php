<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $state = [
        "name" => null,
        "email" => null,
        "phone" => null,
        "message" => null,
    ];
    
    public $loaded = [
        "submit" => true,
    ];

    protected $rules = [
        'state.name' => 'required',
        'state.email' => 'required|email',
        'state.phone' => 'required',
        'state.message' => 'required',
    ];

    protected $messages = [
        'state.name.required' => 'The Name cannot be empty.',
        'state.email.required' => 'The Email cannot be empty.',
        'state.email.email' => 'The Email Address format is not valid.',
        'state.phone.required' => 'The Phone cannot be empty.',
        'state.message.required' => 'The Message cannot be empty.',
    ];

    protected function updated($params)
    {
        $this->validateOnly($params);
    }

    public function submitForm()
    {
        $this->loaded['submit'] = false;
        
        $this->validate();
        
        sleep(10);
        
        $this->resetForm();

        $this->loaded['submit'] = true;
    }

    public function resetForm()
    {
        $this->state = array_map(function ($state) {
            return $state = null;
        }, $this->state);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
