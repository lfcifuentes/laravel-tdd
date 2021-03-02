<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;

    protected $fillable = [
    	'url',
		'description',
		'user_id'
	];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
