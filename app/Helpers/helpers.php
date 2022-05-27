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
function partsPrice($id): float
{
    $product = Products::find($id);
    $product = $product->parts;
    $product = json_decode($product, true);
    $partsId = [];
    $partsQuantity = [];
    foreach($product as $item)
    {
        array_push($partsId, $item['id']);
        array_push($partsQuantity, $item['quantity']);
    }
    $partsPrice = [];
    foreach($partsId[0] as $part)
    {
        $part_price =  Parts::find($part);
        array_push($partsPrice, floatval($part_price->price));
    }

    $partsIdAndQuantity = array_combine($partsPrice, $partsQuantity[0]);
    $price = 0;
    foreach($partsIdAndQuantity as $item => $value)
    {
        $price += floatval($item) * floatval($value);
    }
    return floatval($price);
}

function profit($productPrice, $partsPrice)
{
    return intval($productPrice) - intval($partsPrice);
}
