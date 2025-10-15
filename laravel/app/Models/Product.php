<?php

declare (strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Notifiable;
    /**
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'price',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'id',
    ];
}
