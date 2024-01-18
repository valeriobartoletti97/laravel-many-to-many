<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Facades\Auth;

use illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $currentUser= Auth::id();
        $projects = Project::where('user_id', $currentUser)->get();
        return view ('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $technologies= Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $slug= Str::slug($data['name'].'-'.$data['language']);
        $data['slug'] = $slug;

        $created =date('Y-m-d');
        $data['created'] = $created;

        $data['commits'] = 0;

        $data['user_id'] = auth()->id();

        if($request->hasFile('image')){
            $img_path= Storage::put('images', $request->image);
            $data['image'] = $img_path;
        } 
        
        $project = Project::create($data);
        if($request->has('technologies')){
            $project->technologies()->attach($request->technologies);
        }
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        if(Auth::id() == $project->user_id){
            return view('admin.projects.show', compact('project'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
        $data = $request->validated();

        if($project->name!==$data['name']){
            $slug= Str::slug($data['name'].'-'.$data['language']);
        }
        $data['slug'] = $slug;

        $data['user_id'] = auth()->id();
        if($request->hasFile('image')){
            if($project->image){
                Storage::delete($project->image);
            }
            $img_path= Storage::put('images', $request->image);
            $data['image'] = $img_path;
        }
        
        $project->update($data);
        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        } else{
            $project->technologies()->detach();
        }
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        $project->technologies()->detach();
        if($project->image){
            Storage::delete($project->image);
        } 
        $project->delete();

        if(Auth::id() == $project->user_id){
            return to_route('admin.projects.index')->with('message', "$project->name successfully deleted");
        }
        abort(403);
    }
}
