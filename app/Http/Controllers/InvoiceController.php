<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $allInvoices = Invoice::all();
        return view('invoices.invoice-index', [
            'allInvoices' => $allInvoices
        ]);
    }

    public function create()
    {
        $products = Products::all();
        return view('invoices.invoice-new', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Invoice::create($input);

        return redirect('invoice/create')->with('success', 'Invoie added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
