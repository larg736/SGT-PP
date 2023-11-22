<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    
    use HasFactory;
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

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%');
    }

}
