@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class="text-center mt-3 mb-5">Create a new type</h1>
        <form action="{{ route('admin.types.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    required minlength="3" maxlength="200" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>
@endsection
