<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
  protected $fillable = [
    'title',
    'start',
    'end',
    'color',
    'user_id',
  ];

}
