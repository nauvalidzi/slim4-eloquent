<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	protected $table = 'todo';

    protected $fillable = ['title', 'body', 'status', 'updated'];

    public $timestamps = false;
}