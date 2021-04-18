<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
    'id',
    'user_id',
    'pstart_date',
    'flowdays',
    'age',
  ];
// protected $guarded = [];

}
