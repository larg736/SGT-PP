<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'department_user';

    protected $dates = ['deleted_at'];

    public function department()
    {
    	return $this->belongsTo(Department::class);
    }

    public function level()
    {
    	return $this->belongsTo(Level::class);
    }

}
