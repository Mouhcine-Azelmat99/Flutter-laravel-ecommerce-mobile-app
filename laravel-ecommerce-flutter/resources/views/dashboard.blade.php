@extends('layouts.app')

@section('title')
Ecommerce Admin
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 my-3">
                <div class="bg-primary p-5">
                    <h2 class="text-center">Orders</h2>
                    <h1 class="text-center"><?php
                        0
                    ?></h1>

                    <div class="text-center fs-1"><i class="fas fa-clipboard-list"></i></div>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-primary p-5">
                    <h2 class="text-center">Users</h2>
                    <h1 class="text-center">
                        {{ $users->count() }}
                    </h1>

                    <div class="text-center fs-1"><i class="fas fa-users"></i></div>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-primary p-5">
                    <h2 class="text-center">Products</h2>
                    <h1 class="text-center">
                        {{ $products->count() }}
                    </h1>
                    <div class="text-center fs-1"><i class="fas fa-shopping-bag"></i></div>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-primary p-5">
                    <h2 class="text-center">Catergories</h2>
                    <h1 class="text-center">
                        {{ $cats->count() }}
                    </h1>
                    <div class="text-center fs-1">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-5">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                   <td>{{ $user->id }}</td>
                   <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
               </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        <div class="row py-5">
           <table class="table table-striped table-bordered">
             <thead>
               <tr>
                 <th scope="col">Id</th>
                 <th scope="col">Title</th>
                 <th scope="col">Price</th>
                 <th scope="col">Category</th>
                 <th scope="col">Descrption</th>
                 <th scope="col">Image</th>
                 <th scope="col">Actions</th>

               </tr>
             </thead>
             <tbody>
                @foreach ($products as $product)
                <tr>
                   <td>{{ $product->id }}</td>
                   <td>{{ $product->name }}</td>
                   <td>{{ $product->price }}</td>
                   <td>{{ $product->category->name }}</td>
                    <td>{{ $product->desc }}</td>
                    <td><img src="images/{{ $product->img }}" height="70px" width="70px"></td>
                    <td >
                        <div class="d-flex">
                        <div class="p-2 ">
                        <a class="btn btn-danger" name="action" href="del_menu.php"><i class="fas fa-trash-alt"></i>
                        </a>
                        </div>
                        <div class="p-2"><a class="btn btn-primary" name="action" href="edit_menu.php"><i class="fas fa-edit"></i></a>
                        </div>
                        </div>
                        </div>
                    </td>
               </tr>
                @endforeach
             </tbody>
           </table>
           <a class="btn btn-link text-center" href="products">See all products</a>
       </div>

    </div>
@endsection
