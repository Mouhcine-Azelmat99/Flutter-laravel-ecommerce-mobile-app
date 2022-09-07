@extends('layouts.app')

@section('title')
    Products
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="my-2">Products</h1>
            <hr>
        <div class="my-2">
            <a href="{{ route("products.create") }}" class="btn btn-primary px-4">Add Products</a>
        </div>
        </div>
        <div class="row py-5">
            @if (Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }}
            </div>
        @endif
        <table class="table table-striped table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Rating</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->desc }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->rat }}</td>
                <td><img src="/images/{{ $item->img }}" height="70px" width="80px"></td>
                <td >
                    <div class="d-flex">
                    <div class="p-2">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{ $item->id }}"><i class="fas fa-trash-alt"></i></button>
                    </div >
                        {{-- delete modal --}}
                        <div id="delete_modal_{{ $item->id }}" class="modal fade" aria-labelledby="delete_modal_{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-confirm">
                                <div class="modal-content">
                                    <div class="modal-header flex-column">
                                        <h4 class="modal-title w-100">Are you sure?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('products.destroy',$item->id )}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="p-2">
                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_{{ $item->id }}">
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="edit_modal_{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            @if ($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                            @endif
                            <form method="POST" action="{{ route('products.update',$item->id) }}" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $item->name }}" placeholder="Name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">description</label>
                                    <input type="text" name="desc" class="form-control" value="{{ $item->desc }}" placeholder="description">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Price</label>
                                    <input type="number" name="price" class="form-control" value="{{ $item->price }}" placeholder="Price">
                                </div>
                                <div class="mb-3">
                                    <input type="file" name="image" class="form-control" value="{{ $item->image }}" placeholder="Upload image">
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
