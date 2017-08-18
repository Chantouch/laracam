<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{

    protected $guarded = [];
    protected $fillable = ['tag_id', 'taggable_id', 'taggable_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function taggable()
    {
        return $this->morphTo();
    }
}
