<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    //relazione con la tab technology
    //la funzione deve essere al singolare perche il post ha 1 sola techn
    public function technology(){
        return $this->belongsTo(Technology::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    protected $fillable =[
        'title','slug', 'technology_id'
    ];
}
