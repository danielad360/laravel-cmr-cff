@extends('layouts.admin')

@section('main-content')
    <style>
        .table td{
            vertical-align: center !important;
        }
    </style>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Parts list') }}</h1>

    <div class=" justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4">

                <table class="table">
                    <thead>
                    <tr>
                        <th class="align-middle" scope="col">Photo</th>
                        <th class="align-middle" scope="col">Name</th>
                        <th class="align-middle" scope="col">Price</th>
                        <th class="align-middle" scope="col">Stock</th>
                        <th class="align-middle" scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allParts as $part)
                        <tr>
                            <td class="align-middle">
                                    @if($part->image)
                                    <img src="/image/{{ $part->image }}" width="100px">
                                        @endif
                            </td>
                            <td class="align-middle">{{$part->name}}</td>
                            <td class="align-middle">£{{$part->price}}</td>
                            <td class="align-middle">{{$part->stock}}</td>
                            <td class="align-middle">
                                <div class="row">
                                    <div class="col-2">
                                        <form method="post" action="{{route('parts.edit',$part->id)}}">
                                            @method('get')
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Edit</button>
                                        </form>
                                    </div>
                                    <div class="col-2">
                                        <form method="post" action="{{route('parts.destroy',$part->id)}}">
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
