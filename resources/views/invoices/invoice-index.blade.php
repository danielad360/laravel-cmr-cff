@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Invoices list') }}</h1>
    <div class=" justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Invoice number</th>
                        <th scope="col">To</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allInvoices as $invoice)
                        <tr>
                            <td class="align-middle">invoice nr</td>
                            <td class="align-middle">invoice nr</td>
                            <td class="align-middle">invoice nr</td>
                            <td class="align-middle">invoice nr</td>
                            <td class="align-middle">invoice nr</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
