@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    @if(Route::is('invocies.edit'))
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit invoice') }}</h1>
    @else
        <h1 class="h3 mb-4 text-gray-800">{{ __('Add new invoice') }}</h1>
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

                <form action="@if(Route::is('invocies.edit')) {{ route('invocies.update', $invoice->id) }} @else {{ route('invocies.store') }} @endif" method="POST" class="mx-5 my-5" enctype="multiinvoice/form-data">
                    @csrf
                    @if(Route::is('invocies.edit'))
                        @method('PUT')

                    @endif
                    @if(Route::is('invocies.edit'))

                        <div class="col-xs-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <img src="/image/{{ $invoice->image }}" width="250px">
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="inputInvoiceName" class="col-lg-1 col-form-label">From</label>
                        <div class="col-lg-11">
                            <textarea
                            class="form-control"
                            id="inputInvoiceName"
                            name="from"
                            placeholder="From">
                            @if(Route::is('invocies.edit')) {{$invoice->from}} @endif
                        </textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputInvoicePrice" class="col-lg-1 col-form-label">To</label>
                        <div class="col-lg-11">
                            <textarea
                            class="form-control"
                            id="inputInvoiceTo"
                            name="to"
                            placeholder="To">
                            @if(Route::is('invocies.edit')) {{$invoice->to}} @endif
                        </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputinvociestock" class="col-lg-1 col-form-label">Invoice number</label>
                        <div class="col-lg-11">
                            @if(Route::is('invocies.edit'))
                            <input type="number" class="form-control" id="inputinvocienumber" name="number" placeholder="Invoice number" value="{{$invoice->invoice_number}}">
                            @else
                                <input type="number" class="form-control" id="inputinvocienumber" name="number" placeholder="Invoice number" value="">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputinvociestock" class="col-lg-1 col-form-label">Amount</label>
                        <div class="col-lg-11">
                            @if(Route::is('invocies.edit'))
                            <input type="number" class="form-control" id="inputinoiceamount" name="number" placeholder="Invoice amount" value="{{$invoice->amount}}">
                            @else
                                <input type="number" class="form-control" id="inputinoiceamount" name="number" placeholder="Invoice amount" value="">
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputinvociestock" class="col-lg-1 col-form-label">Amount</label>
                        <div class="col-lg-11">
                    <select class="select" multiple data-mdb-placeholder="Example placeholder" id="select-parts" multiple>
                        @foreach ($products as $product )
                        <option value="{{$product->id}}" data-price="{{$product->price}}">{{$product->name}} - £{{$product->price}}</option>

                        @endforeach

                      </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-10">
                            @if(Route::is('invocies.edit'))
                                <button type="submit" class="btn btn-primary">Edit invoice</button>
                            @else
                                <button type="submit" class="btn btn-primary">Add new invoice</button>
                            @endif
                        </div>
                    </div>


                </form>
            </div>

        </div>

    </div>
<script>
         let getButton = document.querySelector('#select-parts');
        getButton.addEventListener('click', () =>{
            console.log(this)
        })

    const selected = document.querySelectorAll('#select-parts option:checked');
const values = Array.from(selected).map(el => el.value);
console.log(values)

</script>
@endsection
