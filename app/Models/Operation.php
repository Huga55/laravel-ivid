<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'time', 'price', 'tariff_id',
  					'status', 'transaction_id', 'month', 'pay_with_autopay'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
}
