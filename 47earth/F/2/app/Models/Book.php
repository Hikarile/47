<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $fillable = ['name', 'isbn'];
	public $timestamps = false;
}
