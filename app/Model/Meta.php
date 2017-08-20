<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = [
        'meta_title', 'meta_keywords', 'meta_description', 'metable_id', 'metable_type'
    ];


    public function metable()
    {
        $this->morphTo();
    }

}
