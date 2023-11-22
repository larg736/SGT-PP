<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public static $rules = [
        'category_id' => 'sometimes|exists:categories,id',
        'severity' => 'required|in:M,N,A',
        'title' => 'required|min:5|max:50',
        'description' => 'required|min:15|max:250',
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    public static $messages = [
        'category_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos.',
        'title.required' => 'Es necesario ingresar un título para la Tarea.',
        'title.min' => 'El título debe presentar al menos 5 caracteres.',
        'title.max' => 'El título puede presentar un maximo de 50 caracteres.',
        'description.required' => 'Es necesario ingresar una descripción para la Tarea.',
        'description.min' => 'La descripción debe presentar al menos 15 caracteres.',
        'description.max' => 'La descripción puede presentar un maximo de 200 caracteres.',
        'photo.image' => 'El archivo cargado debe ser una imagen.',
        'photo.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, svg.',
        'photo.max' => 'El tamaño máximo de la imagen debe ser de 2 MB.',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);   
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function getSeverityFullAttribute()
    {
    	switch ($this->severity) {
    		case 'M':
    			return 'Menor';

    		case 'N':
    			return 'Normal';
    		
    		default:
    			return 'Alta';
    	}
    }

    public function getTitleShortAttribute()
    {
    	return mb_strimwidth($this->title, 0, 30, '...');
    }

    public function getDescriptionShortAttribute()
    {
    	return mb_strimwidth($this->description, 0, 30, '...');
    }

    public function clerk()
    {
        return $this->belongsTo(User::class, 'clerk_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function getClientNameAttribute()
    {
        if ($this->client)
            return $this->client->name;

        return 'Sin asignar';
    }


    public function getClerkNameAttribute()
    {
        if ($this->clerk)
            return $this->clerk->name;

        return 'Sin asignar';
    }

    public function getStateAttribute()
    {
        if ($this->active == 0)
            return 'Resuelto';

        if ($this->clerk_id)
            return 'Asignado';

        return 'Pendiente';
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->whereHas('department', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');})
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhereHas('level', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');});
    }

    public function scopeSearch($query, $search)
    {
    if ($search) {
        return $query->where('id', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }
    return $query;
    }

}
