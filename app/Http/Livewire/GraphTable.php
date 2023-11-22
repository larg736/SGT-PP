<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class GraphTable extends Component
{ 
    public $startDate;
    public $endDate;

    public function render()
    {
        $startDate = $this->startDate ?: now()->subMonth();
        $endDate = $this->endDate ?: now();
    
        $usersByDate = User::selectRaw('count(*) as total, date(created_at) as date')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();
    
        return view('livewire.graph-table', [
            'usersByDate' => $usersByDate,
        ]);
    }
}
