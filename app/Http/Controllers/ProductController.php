<?php

namespace App\Http\Controllers;
use App\Models\Parts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProducts = Products::all();


        return view('products.product-index', [
            'allProducts' => $allProducts,
        ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parts = Parts::all();

        return view('products.product-new', ['parts' => $parts] );


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrWithPartsId = [];
        foreach($request->input('partquantity') as $item)
        {

            $arrWithPartsId['item'] = [
                'id' => $request->input('id'),
                'quantity' => $request->input('partquantity')
            ];
        }

        $product = new Products();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->notes = $request->input('inputText');
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $product->image = "$profileImage";
        }
        $product->parts = json_encode($arrWithPartsId);
        $product->save();


        return redirect('/products/create')->with('success', 'Game is successfully saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
        $product = Products::find($productId);
        $product_parts = json_decode($product->parts);

        $array_with_products_ids = $product_parts->item->id;
        $array_with_products_quantity = $product_parts->item->quantity;
        $array_with_combines_products = array_combine($array_with_products_ids, $array_with_products_quantity);

        $parts = [];
        $array_with_parts_prices = [];
        $counter = 0;
            foreach($array_with_combines_products as $id => $part)
            {
                $part_index = Parts::find($id);

                $parts['item'][$counter] = [
                    'id' => $part_index->id,
                    'image' => $part_index->image,
                    'name' => $part_index->name,
                    'stock'=> $part_index->stock,
                    'quantity'=> $part,
                    'price'=> $part_index->price
                ];
                $counter += 1;
                array_push($array_with_parts_prices, ($part * $part_index->price));
            }
            $parts_price = array_sum($array_with_parts_prices);
        return view('products.product-single', ['product' => $product,
                                                    'parts' => $parts,
                                                    'parts_price' => $parts_price
        ] );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productId)
    {
        $parts = Parts::all();
        $product = Products::find($productId);
        return view('products.product-new', ['product' => $product, 'parts'=>$parts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'  => 'required|max:255',
            'price' => '',
        ]);
        $input = $request->all();

        $arrWithPartsId = [];
        foreach($request->input('partquantity') as $item)
        {

            $arrWithPartsId['item'] = [
                'id' => $request->input('id'),
                'quantity' => $request->input('partquantity')
            ];
        }

        $product = Products::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
            $product->update(['image' => $profileImage]);

        }
        $product->parts = json_encode($arrWithPartsId);
        $product->update($input);


        return redirect('/products/'.$id.'/edit')->with('success', 'Game is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $productID, Products $products)
    {
        $products->destroy($productID);
        return redirect()->route('products.index')
                         ->withSuccess(__('Post delete successfully.'));
    }
}
