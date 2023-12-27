<?php

use Illuminate\Support\Facades\Session;
use Symfony\Component\String\Slugger\AsciiSlugger;
function uploadFile($nameFolder, $file)
{
    $fileName = time() . '_' . $file->getClientOriginalName();
    return $file->storeAs($nameFolder, $fileName, 'public');
}


function getTotalCart()
{
    $cart = session()->get('cart');
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['quantity'] * $item['price'];
    }
    return $total;
}

function getCartDiscount()
{
    if (Session::has('coupon')) {
        $coupon =  Session::get('coupon');
        $subTotal = getTotalCart();
        if ($coupon['discount_type'] === 'amount') {
            return $coupon['discount'];
        } else if ($coupon['discount_type'] === 'percent') {
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            return $discount;
        }
    } else {
        return 0;
    }
}


function getMainCartTotal()
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subTotal = getTotalCart();
        if ($coupon['discount_type'] === 'amount') {
            if ($coupon['discount'] >= getTotalCart()) {
                return 0;
            } else {
                $total = $subTotal - $coupon['discount'];
                return $total;
            }
        } elseif ($coupon['discount_type'] === 'percent') {
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            $total = $subTotal - $discount;
            return $total;
        }
    } else {
        return getTotalCart();
    }
}
function newPrice($subTotal, $percent)
{
    $total  = $subTotal - ($subTotal * $percent / 100);
    return  $total;
}
function formatNumberPrice($number)
{
	return number_format($number, 0, '.', ',') . "đ";
}

function convertVietnameseToEnglish($text)
{
    
    $slugger = new AsciiSlugger();
    $cleanedText = $slugger->slug($text)->replace('-', ' ')->toString();

    return $cleanedText;
}
