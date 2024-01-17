@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class="text-center mt-3 mb-5 text-uppercase">{{$technology->name}}</h1>
        <h3>Project List</h3>
        <ul>
            @forelse ($technology->projects as $project)
                <li>
                    <a href="{{route('admin.projects.show', $project->id)}}">
                        {{$project->name}}
                    </a>
                </li>
            @empty
                <li>No projects</li>
            @endforelse 
        </ul>
    </section>
@endsection