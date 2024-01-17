@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class="text-center mt-3 text-uppercase">Types List</h1>
        <div class="container mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Types Name</th>
                        <th scope="col" class="d-flex justify-content-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (session()->has('message'))
                        <div class="alert alert-success mb-3 mt-3 text-uppercase">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                        @foreach ($types as $type)
                            <tr>
                                <th>
                                    <a href="{{ route('admin.types.show', $type->id) }}">
                                        {{ $type->name }}
                                    </a>
                                </th>
                                <td class="d-flex justify-content-center gap-1">
                                    <button type="button" class="btn btn-primary border border-secondary">
                                        <a href="{{ route('admin.types.show', $type->id) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </button>
                                    <button type="button" class="btn btn-warning border border-secondary">
                                        <a href="{{ route('admin.types.edit', $type->id) }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </button>
                                    <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST"
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
                <a href="{{ route('admin.types.create') }}">
                    <button class="btn btn-primary text-uppercase">
                        Add new type
                    </button>
                </a>
            </div>
        </div>
    </section>
@endsection
