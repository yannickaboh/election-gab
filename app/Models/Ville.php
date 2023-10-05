<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

	public function pays(){
        return $this->hasOne('App\Models\Pays', 'id', 'pays_id');
    }

	public function province(){
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }
}
