<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = ['key', 'value', 'metable_id', 'metable_type'];

}
