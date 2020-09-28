<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    /**
   	* Атрибуты, для которых разрешено массовое назначение.
   	*
   	* @var array
   	*/
  	protected $fillable = ['user_id', 'date', 'time', 'price',
  					'status', 'transaction_id', 'up', 'down'];

    public function user()
    {
    	return $this->belongsTo("App\Models\User");
    }
}
