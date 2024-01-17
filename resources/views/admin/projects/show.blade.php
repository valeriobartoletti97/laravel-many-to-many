@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class="text-center mt-3 mb-5 show-title text-uppercase">{{$project->name}}</h1>
        <h2 class="text-center">This is the page for"{{$project->name}}"</h2>
        @if($project->image)
        <div class="d-flex justify-content-center project-image-wrapper mb-3">
            <img src="{{asset('storage/' . $project->image) }}" alt="{{$project->name}}" class="project-image">
        </div>
        @endif
        @if($project->technologies)
        <div class="d-flex justify-content-center mb-3">
            @foreach ($project->technologies as $technology)
                <a href="{{route('admin.technologies.show', $technology->slug)}}" class="badge text-bg-primary me-1">{{$technology->name}}</a>
            @endforeach
        </div>
        @endif
        <span class="d-block text-center text-uppercase project-type">Project Type: {{$project->type ? $project->type->name : 'Uncategorized'}}</span>
    </section>
@endsection