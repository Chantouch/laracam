<?php

namespace App\Http\Controllers;

use App\Model\Advertise;
use App\Model\AdvertiseType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdvertiseController extends Controller
{
    public $route = 'admin.advertise.';
    public $view = 'admin.advertise.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertises = Advertise::paginate(10);
        return view($this->view . 'index', compact('advertises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $advertise_types = AdvertiseType::all();
        return view($this->view . 'create', compact('advertise_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data, Advertise::rule(), Advertise::message());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['slug'] = str_slug($request->provider_name, '-');
            $advertise = Advertise::with('ads_type')->create($data);
            if (!$advertise) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Can not insert your data requirement');
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Advertise created successfully');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Advertise $advertise
     * @return \Illuminate\Http\Response
     */
    public function show(Advertise $advertise)
    {
        return response($advertise, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Advertise $advertise
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertise $advertise)
    {
        $advertise_types = AdvertiseType::all();
        return view($this->view . 'edit', compact('advertise', 'advertise_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Advertise $advertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertise $advertise)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data, Advertise::rule(), Advertise::message());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if (empty($advertise->slug)) {
                $data['slug'] = str_slug($request->provider_name, '-');
            }
            $ads = $advertise->update($data);
            if (!$ads) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Can not insert your data requirement');
            }
            DB::commit();
            return redirect()->route($this->route . 'index')->with('success', 'Advertise updated successfully');
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Advertise $advertise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertise $advertise)
    {
        $ads = $advertise->delete();
        if (!$ads) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Can not insert your data requirement');
        }
        return redirect()->route($this->route . 'index')->with('warning', 'Advertise deleted successfully');
    }
}
