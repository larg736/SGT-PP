<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'department_id'];

    protected $dates = ['deleted_at'];

    public function department()
    {
    	return $this->belongsTo(Department::class);
    }
}
