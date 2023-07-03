<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name', 'department_id'];

    public function department()
    {
    	return $this->belongsTo(Department::class);
    }
}
