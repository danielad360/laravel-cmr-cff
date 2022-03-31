@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    @if(Route::is('parts.edit'))
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit part') }}</h1>
    @else
        <h1 class="h3 mb-4 text-gray-800">{{ __('Add new part') }}</h1>
    @endif
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    @php
@endphp
    <div class=" justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4">

                <form action="@if(Route::is('parts.edit')) {{ route('parts.update', $part->id) }} @else {{ route('parts.store') }} @endif" method="POST" class="mx-5 my-5" enctype="multipart/form-data">
                    @csrf
                    @if(Route::is('parts.edit'))
                        @method('PUT')

                    @endif
                    @if(Route::is('parts.edit'))

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <img src="/image/{{ $part->image }}" width="250px">
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="inputPartName" class="col-sm-1 col-form-label">Part name</label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="inputPartName" name="name" placeholder="Part Name" value="@if(Route::is('parts.edit')) {{$part->name}} @endif">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPartPrice" class="col-sm-1 col-form-label">Part price</label>
                        <div class="col-sm-11">
                            @if(Route::is('parts.edit'))
                            <input type="number" step="0.01" class="form-control" name="price" id="inputPartPrice" placeholder="Part price" value="{{$part->price}}">
                            @else
                                <input type="number" step="0.01" class="form-control" name="price" id="inputPartPrice" placeholder="Part price" value="">

                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPartStock" class="col-sm-1 col-form-label">Part stock</label>
                        <div class="col-sm-11">
                            @if(Route::is('parts.edit'))
                            <input type="number" class="form-control" id="inputPartStock" name="stock" placeholder="Part stock" value="{{$part->stock}}">
                            @else
                                <input type="number" class="form-control" id="inputPartStock" name="stock" placeholder="Part stock" value="">
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-sm-1 col-form-label">Image</label>
                        <div class="col-sm-11">
                            @if(Route::is('parts.edit'))

                        <input type="file" name="image" class="form-control" src="/images/{{$part->image}}" placeholder="image">
                            @else
                                <input type="file" name="image" class="form-control" placeholder="image">

                            @endif

                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-10">
                            @if(Route::is('parts.edit'))
                                <button type="submit" class="btn btn-primary">Edit part</button>
                            @else
                                <button type="submit" class="btn btn-primary">Add new part</button>
                            @endif
                        </div>
                    </div>


                </form>
            </div>

        </div>

    </div>

@endsection
