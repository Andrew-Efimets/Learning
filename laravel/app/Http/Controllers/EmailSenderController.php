<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ProductsMail;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class EmailSenderController
{
    public static function sendMail(Product $product)
    {
        $data = [
            'name' => $product->user->name,
            'message' => $product->name,
        ];
        Mail::to($product->user->email)->send(new ProductsMail($data));

        return true;
    }
}
