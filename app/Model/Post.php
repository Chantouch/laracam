<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Post extends Model
{

    use Sluggable;
    //use SoftDeletes;
    protected $guarded = [];
    protected $fillable = [
        'title', 'description', 'slug', 'user_id', 'active', 'path'
    ];

    public static function rule()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|min:20',
            'slug' => 'required',
            'categories' => 'required'
        ];
    }

    public static function message()
    {
        return [];
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    //-----------Relationship--------------//

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id')->withPivot('post_id', 'category_id')->withTimestamps();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphOne
     */
    public function images()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function meta_key()
    {
        return $this->morphOne(Meta::class, 'metable');
    }

}
