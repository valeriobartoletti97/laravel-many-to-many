<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $technologies = Technology::all();
        return view('admin.technologies.index',compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        //
        //
        $data = $request->validated();
        //CREATE SLUG
        $slug = Str::slug($data['name']). '-';
        //add slug to data
        $data['slug'] = $slug;
        $technology = Technology::create($data);
        return to_route('admin.technologies.index', $technology->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
        return view('admin.technologies.show',compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        //
        return view('admin.technologies.edit',compact('technology'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        //
        $data = $request->validated();
        $data['slug'] = $technology->slug;
        if ($technology->name !== $data['name']) {
            //CREATE SLUG
            $slug = Str::slug($data['name']). '-';
            $data['slug'] = $slug;
        }
        $technology->update($data);
        return to_route('admin.technologies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        //
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', "$technology->name successfully deleted");
    }
}
