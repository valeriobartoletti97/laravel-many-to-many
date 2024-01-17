@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class="text-center mt-3 mb-5">Create a new project</h1>
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Your Project name</label>
                <input type="text" name="name" id="name" class="form-control" @error('name') is-invalid @enderror
                    required maxlength="100" minlength="3" value="old{{ $project->name }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="language" class="form-label">Language</label>
                <select name="language" id="language" class="form-select" required>
                    <option value="Html">Html</option>
                    <option value="Javascript">Javascript</option>
                    <option value="Php">Php</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="type_id">Select type</label>
                <select class="form-control @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                    <option value="">Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Url</label>
                <input type="url" value="{{old('url',$project->url)}}" name="url" id="url" class="form-control">
            </div>
            @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <div class="form-group">
                    <h5>Select Technologies</h5>
                    @foreach($technologies as $technology)
                        <div class="form-check @error('technologies') is-invalid @enderror">
                            <label class="form-check-label">{{$technology->name}}</label>
                            <input class="form-check-input" type="checkbox" value="{{$technology->id}}" name="technologies[]" id="technologies" {{$project->technologies->contains($technology->id)? 'checked' : '' }}>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex mb-3 align-items-end">
                @if ($project->image)
                    <div class="me-1">
                        <img id="uploadPreview" width="200" src="{{ asset('storage/' . $project->image) }}">
                    </div>
                @else
                    <div class="me-1">
                        <img id="uploadPreview" width="200" src="https://via.placeholder.com/300x200">
                    </div>
                @endif
                <div class="">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                        id="image" value="{{ old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary text-uppercase">Apply Changes</button>
        </form>
    </section>
@endsection
