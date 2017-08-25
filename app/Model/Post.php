<?php

namespace App\Model;

use App\Http\Traits\Mediable;
use App\Scopes\PostedScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
	use Mediable;
	protected $guarded = [];
	protected $dates = ['posted_at'];
	protected $fillable = [
		'title', 'description', 'slug', 'user_id', 'active', 'path', 'thumbnail_id', 'posted_at'
	];

	public static function rule()
	{
		return [
			'title'       => 'required|max:255',
			'description' => 'required|min:20',
			'categories'  => 'required'
		];
	}

	public static function message()
	{
		return [];
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

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new PostedScope);
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName(): string
	{
		if (request()->expectsJson()) {
			return 'id';
		}
		return 'slug';
	}

	/**
	 * Scope a query to order posts by latest posted
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeLatest($query)
	{
		return $query->orderBy('posted_at', 'desc');
	}

	/**
	 * Scope a query to only include posts posted last month.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param int $limit
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeLastMonth($query, $limit = 5)
	{
		return $query->whereBetween('posted_at', [Carbon::now()->subMonth(), Carbon::now()])
			->latest()
			->limit($limit);
	}

	/**
	 * Scope a query to only include posts posted last week.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeLastWeek($query)
	{
		return $query->whereBetween('posted_at', [Carbon::now()->subWeek(), Carbon::now()])
			->latest();
	}

	/**
	 * Check if the post has a valid thumbnail
	 *
	 * @return boolean
	 */
	public function hasThumbnail(): bool
	{
		return $this->hasMedia($this->thumbnail_id);
	}

	/**
	 * Retrieve the post's thumbnail
	 *
	 * @return mixed
	 */
	public function thumbnail()
	{
		return $this->media()->where('id', $this->thumbnail_id)->first();
	}

	/**
	 * Store and set the post's thumbnail
	 *
	 * @param UploadedFile $thumbnail
	 * @return UploadedFile
	 */
	public function storeAndSetThumbnail(UploadedFile $thumbnail)
	{
		$thumbnail_name = $thumbnail->store('uploads/posts');
		if (!count($this->media)) {
			$media = $this->media()->create([
				'filename'          => $thumbnail_name,
				'original_filename' => $thumbnail->getClientOriginalName(),
				'mime_type'         => $thumbnail->getMimeType()
			]);
			$this->update(['thumbnail_id' => $media->id]);
		} else {
			$old_file = [$this->media()->first()->filename];
			if (File::exists(storage_path('app/uploads/posts'))) {
				Storage::delete($old_file);
			}
			$this->media()->first()->update([
				'filename'          => $thumbnail_name,
				'original_filename' => $thumbnail->getClientOriginalName(),
				'mime_type'         => $thumbnail->getMimeType()
			]);
		}
		return $thumbnail;
	}

	public function storeAndSetAuthor()
	{
		if (empty($this->user_id)) {
			$this->user_id = auth()->id();
		}
	}

	/**
	 * Return the post's author
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * Return the post's comments
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\morphMany
	 */
	public function comments()
	{
		return $this->morphMany(Comment::class, 'commentable');
	}

	/**
	 * return the excerpt of the post content
	 *
	 * @param  $length
	 * @return string
	 */
	public function excerpt($length = 50): string
	{
		return str_limit($this->description, $length);
	}

}
