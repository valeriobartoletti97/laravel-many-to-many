@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class="text-center mt-3 mb-5 show-title text-uppercase">{{$project->name}}</h1>
        <h2 class="text-center mb-5">This is the page for"{{$project->name}}"</h2>
        @if($project->image)
        <div class="d-flex justify-content-center project-image-wrapper mb-3">
            <img src="{{asset('storage/' . $project->image) }}" alt="{{$project->name}}" class="project-image">
        </div>
        @endif
        @if($project->technologies)
        <div class="d-flex justify-content-center mb-2">
            @foreach ($project->technologies as $technology)
                <a href="{{route('admin.technologies.show', $technology->id)}}" class="badge text-uppercase text-bg-primary me-1">{{$technology->name}}</a>
            @endforeach
        </div>
        @endif
        <span class="d-block text-center text-uppercase project-type">Project Type: 
            @if($project->type)
            <a href="{{route('admin.types.show', $project->type->id)}}" class="badge text-bg-success">{{$project->type ? $project->type->name : 'Uncategorized'}}</a>
            @else
            <span class="text-uppercase">Uncategorized</span>
            @endif
        </span>
    </section>
@endsection