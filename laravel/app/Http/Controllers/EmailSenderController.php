<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ProductsMail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailSenderController
{
    public function index(string $id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);
        $data = [
          'name' => $user->name,
          'message' => $product->name,
        ];

        $mailObj = new ProductsMail($data);
        Mail::to($user->email)->send($mailObj);
        return redirect()->route('home');
    }
}
