<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;

	public function candidat(){
        return $this->hasOne('App\Models\User', 'id', 'candidat_id');
    }

	public function election(){
        return $this->hasOne('App\Models\Election', 'id', 'election_id');
    }

	public function centre(){
        return $this->hasOne('App\Models\Centre', 'id', 'centre_id');
    }

	public function bureau(){
        return $this->hasOne('App\Models\Bureau', 'id', 'bureau_id');
    }
}
