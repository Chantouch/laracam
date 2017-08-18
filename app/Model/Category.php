<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Category extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'name', 'slug', 'description', 'status', 'parent_id'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->whereNotNull('parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     * Get all of the tags for the post.
     */

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @return string
     */
    public function tagList()
    {
        $tag = $this->tags;
        $tags = array();
        foreach ($tag as $tg) {
            $tags[$tg->name] = $tg->name;
        }
        return implode(', ', $tags);
    }

    //===============Validation===============//
    public static function rules($id = null)
    {
        switch (Request::method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required|unique:categories|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|unique:categories,name,' . $id . ',id',
                ];
            }
            default:
                break;
        }
        return self::rules($id);
    }

    public static function messages()
    {
        return [

        ];
    }
}
