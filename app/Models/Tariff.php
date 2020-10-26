<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    public function info()
    {
    	return $this->belongsTo('App\Models\Info', 'tariff_id', 'id');
    }
}
