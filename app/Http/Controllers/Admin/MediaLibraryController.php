<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\Admin\MediaLibraryRequest;
use App\Model\MediaLibrary;
use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if ($request->hasFile('file')) {
			if ($request->file('file')->isValid()) {
				$upload = new MediaLibrary();
				$upload->storeMediaLibrary($request->file('file'));
			}
		}
		return response()->json(['success' => 'Media has been uploaded to server'], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Model\MediaLibrary $mediaLibrary
	 * @return \Illuminate\Http\Response
	 */
	public function show(MediaLibrary $mediaLibrary)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Model\MediaLibrary $mediaLibrary
	 * @return \Illuminate\Http\Response
	 */
	public function edit(MediaLibrary $mediaLibrary)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Model\MediaLibrary $mediaLibrary
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, MediaLibrary $mediaLibrary)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Model\MediaLibrary $mediaLibrary
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(MediaLibrary $mediaLibrary)
	{
		//
	}
}
