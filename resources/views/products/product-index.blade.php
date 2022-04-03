@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Products list') }}</h1>

    <div class=" justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Parts price</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($allProducts as $product)

                        <tr>
                            <td class="align-middle"> <img width="100px" src="image/{{$product->image}}"></td>

                            <td class="align-middle"> <a href="/products/{{$product->id}}">{{$product->name}}   </a></td>

                            <td class="align-middle">£{{$product->price}}</td>
                            <td class="align-middle">{{partsPrice($product->id)}}
                            <td class="align-middle">
                                <div class="row">
                                    <div class="col-2">
                                        <form method="post" action="{{route('products.edit',$product->id)}}">
                                            @method('get')
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Edit</button>
                                        </form>
                                    </div>
                                    <div class="col-2">
                                        <form method="post" action="{{route('products.destroy',$product->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>

@endsection
