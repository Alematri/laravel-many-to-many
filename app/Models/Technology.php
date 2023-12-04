<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    //relazione con la tabella projects
    //creo una funzione col nome della tabella e all'interno definisco l'appartenenza
    //ogni categoria ha tanti post
    //a questa funzione accederò come proprietà della classe Technology

    public function projects(){
        return $this->hasMany(Project::class);
    }

    protected $fillable = [
        'name','slug'
    ];
}
