@extends('layouts.app')

@section('title')
    Add Products
@endsection

@section('content')
    <div class="container">
        <h1 class="my-2">Add Products</h1>
        <hr>
        <div class="row py1">
            @if (Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }}
            </div>
        @endif
        </div>
        <div class="row">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="my-2">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="my-2">
                    <label for="desc" class="form-label">Description</label>
                    <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required></textarea>
                    @error('desc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="my-2">
                    <label for="price" class="form-label">price</label>
                    <input id="price" type="number" step="0.5" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="my-2">
                    <label for="category_id" class="form-label">Categeory</label>
                    <select class="form-select" name="category_id" required>
                        @foreach ($categories as $cat )
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                      </select>
                    @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="my-2">
                    <label for="image" class="form-label">Image</label>
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-lg btn-danger">Confirme</button>
                </div>
            </form>
        </div>
    </div>
@endsection
