@extends('layouts.app')
{{-- @php
dd($projects)
@endphp --}}
@section('content')
    <section class="container">
        <div class="container mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Project Name</th>
                        <th scope="col">Language</th>
                        <th scope="col">Commits</th>
                        <th scope="col">Created</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (session()->has('message'))
                        <div class="alert alert-success mb-3 mt-3 text-uppercase">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                        @foreach ($projects as $project)
                            <tr>
                                <th>
                                    <a href="{{ route('admin.projects.show', $project->id) }}">
                                        {{ $project->name }}
                                    </a>
                                </th>
                                <td>{{ $project->language }}</td>
                                <td>{{ $project->commits }}</td>
                                <td>{{ $project->created }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary border border-secondary">
                                        <a href="{{ route('admin.projects.show', $project->id) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </button>
                                    <button type="button" class="btn btn-warning border border-secondary">
                                        <a href="{{ route('admin.projects.edit', $project->id) }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </button>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger border border-secondary">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="container mt-2 pb-5 d-flex justify-content-center align-content-center">
                <a href="{{ route('admin.projects.create') }}">
                    <button class="btn btn-primary text-uppercase">
                        Add new Project
                    </button>
                </a>
            </div>
        </div>
    </section>
@endsection
