<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Livewire\Forms\UserForm;
use App\Models\Country;
use Livewire\WithFileUploads;
// use Livewire\Attributes\Layout;

class UserCreate extends Component
{
    use WithFileUploads;

    public UserForm $form;

    public function save(){
        
        $user = $this->form->saveUser();    
        $this->dispatch('user-created', $user); 
        $this->redirectRoute('home', navigate: true); 
    }


    // #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-create', [
            'countries' => Country::all(),
        ]);
    }
}
