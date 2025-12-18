<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ProductsMail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class EmailSenderController
{
    public static function sendMail(Product $product)
    {
        if (Gate::allows('sendMail', $product)) {
            $data = [
                'name' => auth()->user()->name,
                'message' => $product->name,
            ];
            Mail::to(auth()->user()->email)->send(new ProductsMail($data));
        }

        return true;
    }
}
