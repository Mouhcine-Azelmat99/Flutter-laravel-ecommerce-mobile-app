@extends('layouts.app')

@section('title')
    Orders admin
@endsection

@section('content')
    <div class="container">
        <h1 class="my-2">Orders</h1>
        <hr>
        <div class="row">
            @if (Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }}
            </div>
            @endif
        <table class="table table-striped table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">Items</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Total</th>
                <th scope="col">Created at</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
                @isset($result)


                @foreach ($result as $order)
            <tr>
                <td>
                    @foreach($order as $item)
                        -<span class="text-danger">  {{ $item->qty }}</span> {{ $item->product->name }}
                    @endforeach
                </td>
                <td>{{ $order[0]->user->name }}</td>
                <td>{{ $order[0]->user->email }}</td>
                <td>
                    {{ $order->total }}
                </td>
                <td>{{ $order[0]->created_at }}</td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{ $order[0]->user->id }}"> Confirme <i class="fas fa-check"></i></button>
                    </div >
                    <div id="delete_modal_{{ $order[0]->user->id }}" class="modal fade" aria-labelledby="delete_modal_{{ $order[0]->user->id }}" aria-hidden="true">
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
                                    <form action="{{ route('orders.destroy',$order[0]->user->id )}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
            @endforeach
            @endisset


            </tr>
            </tbody>
        </table>
    </div>
    </div>
@endsection
