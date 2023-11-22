<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Demand;


class DemandsTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public $startDate;
    public $endDate;

    public $showingModal = false;

    protected $listeners = ['destroy'];

    protected $queryString = [
        'orderBy' => ['except' => 'id'],
        'orderAsc' => ['except' => true],
    ];

    public function render()
    {
        return view('livewire.demands-table', [
            'demands' => Demand::search($this->search)
                ->when(!empty($this->startDate) && !empty($this->endDate), function ($query) {
                    return $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
                })
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

    public function destroy(Demand $demand){
        $demand->delete();
    }

    public function restore($id)
    {
        Demand::where('id', $id)->withTrashed()->restore();
    }

}
