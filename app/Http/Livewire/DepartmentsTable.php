<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Department;
use App\Models\Level;

class DepartmentsTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public $showingModal = false;

    protected $listeners = ['destroy'];

    protected $queryString = [
        'orderBy' => ['except' => 'id'],
        'orderAsc' => ['except' => true],
    ];

    public function render()
    {
        return view('livewire.departments-table', [
            'departments' => Department::search($this->search)
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

    public function destroy(Department $department){
        $department->delete();
    }

    public function restore($id)
    {
        Department::where('id', $id)->withTrashed()->restore();
    }
}
