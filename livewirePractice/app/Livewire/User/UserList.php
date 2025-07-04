<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
// use Livewire\Attributes\Layout;
// use Livewire\WithoutUrlPagination;

class UserList extends Component
{
    use WithPagination;

    #[Url]
    public int $limit = 10;
    public array $limitList = [10,25,50,100];
    #[Url]
    public string $search = '';

    public function mount(){
        if(!in_array($this->limit,$this->limitList)){
            $this->redirectRoute('home');
        }
    }

    public function updating($property, $value){
        if($property == 'search'){
            $this->resetPage();
        }
    }

    public function delete(int $id){
        User::find($id)->delete();
    }

    
    #[On('user-created')]
    public function updateUserList($user = null){

    }

    // #[Layout('layouts.app')]
    #[Title('Users List')]
    public function render()
    {
        return view('livewire.user.user-list', [
            'users' => User::with('country')
            ->select('users.id', 'users.name', 'users.email', 'countries.name as country_name')
            ->join('countries', 'users.country_id', '=', 'countries.id')
            ->when($this->search, function($query){
                $query->whereLike('users.name', '%' . $this->search . '%')
                ->orWhereLike('users.email', '%' . $this->search . '%')
                ->orWhereLike('countries.name', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate($this->limit),
        ]);
    }
}
