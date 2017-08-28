<?php

namespace App\Transformers;

use App\Model\MediaLibrary;
use League\Fractal\TransformerAbstract;
use App\Model\Post;

class MediaLibraryTransformer extends TransformerAbstract
{
	/**
	 * Transform a post.
	 *
	 * @param MediaLibrary $mediaLibrary
	 * @return array
	 */
	public function transform(MediaLibrary $mediaLibrary): array
	{
		return [
			'id'             => $mediaLibrary->id,
			'title'          => $mediaLibrary->title,
			'alt_text'           => $mediaLibrary->alt_text,
			'description'        => $mediaLibrary->description,
			'created_at'      => $mediaLibrary->created_at->toIso8601String(),
		];
	}
}
