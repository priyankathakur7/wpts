<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
    'user_id',
    'pstart_date',
    'flowdays',
    'age',
    'result_date'
  ];
// protected $guarded = [];

}
