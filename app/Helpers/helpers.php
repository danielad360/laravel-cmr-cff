<?php


use App\Models\Parts;
use App\Models\Products;

function valueIndex($array): int
{
    $count = 0;
    foreach($array as $item =>$value)
    {
        $mnoze = intval($item) * intval($value);
        $count += $mnoze;
    }
    return $count;
}
function partsPrice($id): int
{
    $product = Products::find($id);
    $product = $product->parts;
    $product = json_decode($product, true);
    $products = $product['item']['id'];
    $part_prices = [];
    foreach($products as $item)
    {
        $part_price =  Parts::find($item);
        array_push($part_prices, $part_price->price);
    }
    $product['item']['prices'] = $part_prices;
    $concat_arrays = array_combine($product['item']['prices'], $product['item']['quantity']);
    $product['item']['total'] = valueIndex($concat_arrays);

    return $product['item']['total'];

}
