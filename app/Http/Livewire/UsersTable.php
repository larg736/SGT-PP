<?php

namespace App\Http\Livewire;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{ 
    use WithPagination;

    public $perPage = '10';
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public $showingModal = false;

    protected $listeners = ['destroy', 'hideMe' => 'hideModal'];

    protected $queryString = [
        'orderBy' => ['except' => 'id'],
        'orderAsc' => ['except' => true],
        'perPage' => ['except' => '10'],
    ];

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->withTrashed()
                ->paginate($this->perPage),
        ]);
    }

    public function orderBy( $field) 
    {
        if( $field == $this->orderBy) {
            $this->orderAsc = !$this->orderAsc;
        }
        $this->orderBy = $field;
    }

    public function showModal(){
        $this->showingModal = true;
    }

    public function hideModal(){
        $this->showingModal = false;
    }

    public function destroy(User $user){
        $user->delete();
    }
}