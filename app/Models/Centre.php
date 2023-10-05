<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    use HasFactory;

	public function ville(){
        return $this->hasOne('App\Models\Ville', 'id', 'ville_id');
    }

	public function responsable(){
        return $this->hasOne('App\Models\User', 'id', 'responsable_id');
    }
}
