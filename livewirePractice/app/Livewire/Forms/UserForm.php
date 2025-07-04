<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\User;

class UserForm extends Form
{
    // #[Validate('required|min:2')]
    public string $name = '';
    
    // #[Validate('required|email')]
    public string $email = '';

    // #[Validate('required|max:6')]
    public string $password = '';

    public string $country_id = '';

    #[Validate('nullable|image|max:2048')]
    public $avatar;

    protected function rules():array
    {
        return [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|max:6',
            'country_id' => 'required|exists:countries,id',
        ];
    }


    public function saveUser(){
        $validated = $this->validate();
        if($this->avatar){
            $folders = date('Y') . '/' . date('m') . '/' . date('d');
            
            $validated['avatar'] = $this->avatar->store($folders);
        }
            
        
        $user = User::create($validated);
        $this->reset();
        session()->flash('success', 'User created successfully');
        return $user;
    }
}
