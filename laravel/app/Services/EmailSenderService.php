<?php

namespace App\Services;

use App\Mail\BuyMail;
use App\Mail\ProductsMail;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class EmailSenderService
{

    protected static function sendMail(Product $product, string $emailClass)
    {
        $data = [
            'name' => $product->user->name,
            'message' => $product->name,
        ];

        Mail::to($product->user->email)->send(new $emailClass($data));
    }
    public static function sendNewProductMail(Product $product)
    {
        self::sendMail($product, ProductsMail::class);

        return true;
    }

    public static function sendBuyProductMail(Product $product)
    {
        self::sendMail($product, BuyMail::class);

        return true;
    }
}
