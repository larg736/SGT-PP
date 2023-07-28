<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{

    public static $rules = [
        'category_id' => 'sometimes|exists:categories,id',
        'severity' => 'required|in:M,N,A',
        'title' => 'required|min:5',
        'description' => 'required|min:15'
    ];

    public static $messages = [
        'category_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos.',
        'title.required' => 'Es necesario ingresar un título para la incidencia.',
        'title.min' => 'El título debe presentar al menos 5 caracteres.',
        'description.required' => 'Es necesario ingresar una descripción para la incidencia.',
        'description.min' => 'La descripción debe presentar al menos 15 caracteres.'
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
    	return mb_strimwidth($this->title, 0, 20, '...');
    }

    public function clerk()
    {
        return $this->belongsTo(User::class, 'clerk_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
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

}
