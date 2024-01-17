<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Requests\StoretypesRequest;
use App\Http\Requests\UpdatetypesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $types = Type::All();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretypesRequest $request)
    {
        //
        $data = $request->validated();
        //CREATE SLUG
        $slug = Str::slug($data['name']). '-';
        //add slug to data
        $data['slug'] = $slug;
        $type = Type::create($data);
        return to_route('admin.types.index', $type->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetypesRequest $request, Type $type)
    {
        //
        $data = $request->validated();
        $data['slug'] = $type->slug;
        if ($type->name !== $data['name']) {
            //CREATE SLUG
            $slug = Str::slug($data['name']). '-';
            $data['slug'] = $slug;
        }
        $type->update($data);
        return to_route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        //
        $type->delete();
        return to_route('admin.types.index')->with('message', "$type->name successfully deleted");
    }
}
