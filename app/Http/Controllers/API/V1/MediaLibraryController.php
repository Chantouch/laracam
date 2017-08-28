<?php

namespace App\Http\Controllers\API\V1;

use App\Model\MediaLibrary;
use App\Transformers\MediaLibraryTransformer;
use Illuminate\Http\Request;

class MediaLibraryController extends ApiController
{
	/**
	 * MediaLibraryController constructor.
	 */
	public function __construct()
	{
		$this->transformer = new MediaLibraryTransformer();
		$this->resourceKey = 'media-library';
	}

	/**
	 * Return the media library.
	 *
	 * @param  Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$media_library = MediaLibrary::latest()->paginate($request->input('limit', 20));
		return $this->paginatedCollection($media_library);
	}

}
