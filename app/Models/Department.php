<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'start',
    ];

    protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function Users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getFirstLevelIdAttribute()
    {
        return $this->levels->first()->id;
    }

}
