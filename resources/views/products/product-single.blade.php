@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
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

    <div class=" justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4 py-5 px-5 ">

                    <div class="form-group row">
                        <div class="col-sm-3">
                            <h2>{{$product->name}}</h2>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <h3>	£{{$product->price}}</h3>{{$parts_price}}
                        </div>
                    </div>
                    <hr class="my-5" />
                    <h4>Product Parts</h4>
                 @foreach($parts['item'] as $part)
                        @if($part['quantity'] > 0)

                        <input type="hidden"  value="{{$part['id']}}" name="id[]" />
                        <div class="form-group row cloneRow">
                            <div class="col-2 d-flex align-items-center justify-content-start">
                                <h5 class="text-success">Need {{$part['quantity']}}</h5><h5 class="mx-2"> of </h5><h5 class="text-danger">{{$part['stock']}}</h5>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <h5 id="partnames" type="text" name="partnames[]" placeholder="Part Name" value="">{{$part['name']}}</h5>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <img width="100px" src="/image/{{$part['image']}}">
                            </div>

                        </div>

                    @endif
                    @endforeach

            </div>

        </div>

    </div>



@endsection
