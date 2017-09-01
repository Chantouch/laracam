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

	/**
	 * Return the media library.
	 *
	 * @param $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$media_library = MediaLibrary::find($id);
		return response($media_library, 200);
	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function update(Request $request, $id)
	{
		$data = $request->all();
		$media_library = MediaLibrary::find($id);
		$media_library->update($data);
		return response()->json(['data'=> 'Media library detail updated!']);
	}

	/**
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id)
	{
		$media_library = MediaLibrary::find($id);
		$media_library->delete();
		return response()->json(['data' => 'Media library deleted!']);
	}

}
